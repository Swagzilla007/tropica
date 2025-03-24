<?php
    include "db_config.php";
        class user
        {
            public $db;
            public function __construct()
            {
                $this->db=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,'hotel');
                if(mysqli_connect_errno())
                {
                    echo "Error: Could not connect to database.";
                    exit;
                }
            }
            public function reg_user($name, $username, $password, $email)
            {
                //$password=md5($password);
                $sql="SELECT * FROM manager WHERE uname='$username' OR uemail='$email'";
                $check=$this->db->query($sql);
                $count_row=$check->num_rows;
                if($count_row==0)
                {
                    $sql1="INSERT INTO manager SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
                    $result= mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
                    return $result;
                }
                else
                {
                    return false;
                }
            }
            
            
            public function add_room($roomname, $room_qnty, $no_bed, $bedtype,$facility,$price)
            {
                
                    $available=$room_qnty;
                    $booked=0;
                    
                    $sql="INSERT INTO room_category SET roomname='$roomname', available='$available', booked='$booked', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype', facility='$facility', price='$price'";
                    $result= mysqli_query($this->db,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
                
                
                    for($i=0;$i<$room_qnty;$i++)
                    {
                        $sql2="INSERT INTO rooms SET room_cat='$roomname', book='false'";
                        mysqli_query($this->db,$sql2);
                        
                    }
                
                    return $result;
                

            }
            
            public function check_available($checkin, $checkout) 
            {
                // First validate dates
                if(strtotime($checkout) <= strtotime($checkin)) {
                    return false;
                }

                // Get room categories with available room count for selected dates
                $sql = "SELECT rc.*, 
                        (
                            SELECT COUNT(*) 
                            FROM rooms r 
                            WHERE r.room_cat = rc.roomname 
                            AND (
                                r.book = 'false' 
                                OR (r.book = 'true' AND 
                                    (r.checkout < '$checkin' OR r.checkin > '$checkout')
                                )
                            )
                        ) as available_rooms,
                        (
                            SELECT COUNT(*) 
                            FROM rooms r 
                            WHERE r.room_cat = rc.roomname
                        ) as total_rooms
                        FROM room_category rc
                        HAVING available_rooms > 0";

                $check = mysqli_query($this->db, $sql);
                if(!$check) {
                    error_log("Query failed: " . mysqli_error($this->db));
                    return false;
                }
                return $check;
            }
            
            public function booknow($checkin, $checkout, $name, $phone, $roomname)
            {
                // Debug info
                error_log("Attempting to book room category: " . $roomname);
                
                // Get available room in the category
                $sql = "SELECT * FROM rooms 
                        WHERE room_cat = '" . mysqli_real_escape_string($this->db, $roomname) . "' 
                        AND book = 'false' 
                        LIMIT 1";
                        
                $check = mysqli_query($this->db, $sql);
                
                if(!$check) {
                    error_log("Query failed: " . mysqli_error($this->db));
                    return "Database error: " . mysqli_error($this->db);
                }
                
                if(mysqli_num_rows($check) > 0) {
                    $row = mysqli_fetch_array($check);
                    $id = $row['room_id'];
                    
                    // Start transaction
                    mysqli_begin_transaction($this->db);
                    
                    try {
                        // Update room status
                        $sql2 = "UPDATE rooms SET 
                                checkin = '" . mysqli_real_escape_string($this->db, $checkin) . "',
                                checkout = '" . mysqli_real_escape_string($this->db, $checkout) . "', 
                                name = '" . mysqli_real_escape_string($this->db, $name) . "',
                                phone = '" . mysqli_real_escape_string($this->db, $phone) . "',
                                book = 'true' 
                                WHERE room_id = $id";
                                
                        if(!mysqli_query($this->db, $sql2)) {
                            throw new Exception("Failed to update room");
                        }
                        
                        // Update room category counts
                        $sql3 = "UPDATE room_category SET 
                                available = available - 1,
                                booked = booked + 1 
                                WHERE roomname = '" . mysqli_real_escape_string($this->db, $roomname) . "'";
                                
                        if(!mysqli_query($this->db, $sql3)) {
                            throw new Exception("Failed to update room category");
                        }
                        
                        mysqli_commit($this->db);
                        
                        return "Booking Confirmed!\n" .
                               "Room Type: " . $roomname . "\n" .
                               "Check-in: " . $checkin . "\n" .
                               "Check-out: " . $checkout . "\n" .
                               "Guest Name: " . $name;
                               
                    } catch(Exception $e) {
                        mysqli_rollback($this->db);
                        error_log("Booking failed: " . $e->getMessage());
                        return "Error making booking: " . $e->getMessage();
                    }
                } else {
                    return "No rooms available in category: " . $roomname;
                }
            }
            
            public function edit_all_room($checkin, $checkout, $name, $phone, $id)
            {
                // Start transaction
                mysqli_begin_transaction($this->db);
                
                try {
                    // Update room details
                    $sql2 = "UPDATE rooms SET 
                            checkin = '" . mysqli_real_escape_string($this->db, $checkin) . "',
                            checkout = '" . mysqli_real_escape_string($this->db, $checkout) . "',
                            name = '" . mysqli_real_escape_string($this->db, $name) . "',
                            phone = '" . mysqli_real_escape_string($this->db, $phone) . "'
                            WHERE room_id = $id";
                            
                    if(!mysqli_query($this->db, $sql2)) {
                        throw new Exception("Failed to update room details");
                    }
                    
                    mysqli_commit($this->db);
                    return "Booking Updated Successfully!";
                    
                } catch(Exception $e) {
                    mysqli_rollback($this->db);
                    error_log("Booking update failed: " . $e->getMessage());
                    return "Error updating booking: " . $e->getMessage();
                }
            }
            
            public function edit_room_cat($roomname, $room_qnty, $no_bed, $bedtype, $facility, $price, $room_cat)
            {
                mysqli_begin_transaction($this->db);
                
                try {
                    // Delete existing rooms
                    $sql2 = "DELETE FROM rooms WHERE room_cat='$room_cat'";
                    mysqli_query($this->db, $sql2);
                    
                    // Add new rooms
                    for($i=0; $i<$room_qnty; $i++) {
                        $sql3 = "INSERT INTO rooms SET room_cat='$roomname', book='false'";
                        mysqli_query($this->db, $sql3);
                    }
                    
                    $available = $room_qnty;
                    $booked = 0;
                    
                    // Update category
                    $sql = "UPDATE room_category SET 
                            roomname='$roomname', 
                            available='$available', 
                            booked='$booked', 
                            room_qnty='$room_qnty', 
                            no_bed='$no_bed', 
                            bedtype='$bedtype', 
                            facility='$facility', 
                            price='$price' 
                            WHERE roomname='$room_cat'";
                            
                    $send = mysqli_query($this->db, $sql);
                    
                    if($send) {
                        mysqli_commit($this->db);
                        return "Room Category Updated Successfully! Total Rooms: $room_qnty";
                    } else {
                        throw new Exception("Failed to update room category");
                    }
                } catch(Exception $e) {
                    mysqli_rollback($this->db);
                    return "Error: " . $e->getMessage();
                }
            }
            
            public function check_login($emailusername,$password)
            {
                //$password=md5($password);
                $sql2="SELECT uid from manager WHERE uemail='$emailusername' OR uname='$emailusername' and upass='$password'";
                $result=mysqli_query($this->db,$sql2);
                $user_data=mysqli_fetch_array($result);
                $count_row=$result->num_rows;
                
                if($count_row==1)
                {
                    $_SESSION['login']=true;
                    $_SESSION['uid']=$user_data['uid'];
                    return true;    
                }
                else
                {
                    return false;
                }
            }

            public function get_session()
            {
                return $_SESSION['login'];
            }
            public function user_logout()
            {
                $_SESSION['login']=false;
                session_destroy();
            }

            public function delete_booking($room_id) {
                mysqli_begin_transaction($this->db);
                
                try {
                    // Get room category before deletion
                    $sql = "SELECT room_cat FROM rooms WHERE room_id = $room_id";
                    $result = mysqli_query($this->db, $sql);
                    $row = mysqli_fetch_array($result);
                    $room_cat = $row['room_cat'];
                    
                    // Update room status
                    $sql2 = "UPDATE rooms SET 
                            checkin = NULL,
                            checkout = NULL,
                            name = NULL,
                            phone = NULL,
                            book = 'false' 
                            WHERE room_id = $room_id";
                            
                    if(!mysqli_query($this->db, $sql2)) {
                        throw new Exception("Failed to update room status");
                    }
                    
                    // Update room category counts
                    $sql3 = "UPDATE room_category SET 
                            available = available + 1,
                            booked = booked - 1 
                            WHERE roomname = '$room_cat'";
                            
                    if(!mysqli_query($this->db, $sql3)) {
                        throw new Exception("Failed to update room category");
                    }
                    
                    mysqli_commit($this->db);
                    return true;
                    
                } catch(Exception $e) {
                    mysqli_rollback($this->db);
                    error_log("Booking deletion failed: " . $e->getMessage());
                    return false;
                }
            }
        }

?>
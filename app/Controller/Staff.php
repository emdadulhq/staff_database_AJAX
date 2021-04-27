<?php

    namespace Ura\Dhura\Controller;

    use Ura\Dhura\Support\Database;


    /**
     * Class Student
     * @package Ura\Dhura\Controller
     */

    class Staff extends Database {

        /**
         * Staff add to Database
         * @param $name
         * @param $email
         * @param $cell
         */
        public function createStaff($name, $email, $cell, $unique_name){
            $sql = "INSERT INTO staff (name, email, cell, photo) VALUES ('$name','$email','$cell', '$unique_name')";
            $data = $this ->create($sql);

            if ($data) {
                return true;
            }else {
                return false;
            }
        }


        /**
         * All staff
         * @return bool|\mysqli_result
         */
        public function allStaff(){
            return $this ->all('staff');
        }

        /**
         * @param user_id $
         */
        public function deleteStaff($user_id) {

            $delete_user_data = $this ->find('staff', $user_id);
            $delete_data = $delete_user_data -> fetch_assoc();
            unlink('../photos/staff/' . $delete_data['photo'] );
            $data = $this ->delete('staff', $user_id);

            if($data) {
                return true;
            }else {
                return false;
            }

        }

        /**
         * @param $user_id
         */
        public function showStaff($user_id) {

            return $this ->find('staff', $user_id);

        }


        /**
         * @param $name
         * @param $email
         * @param $cell
         * @param $old_photo
         * @param $id
         */
        public function staffUpdate($name, $email, $cell, $photo, $id) {
            $data = $this ->update("UPDATE staff SET name='$name', email='$email', cell='$cell', photo='$photo' WHERE id='$id'");
            if ($data){
                return true;
            }else {
                return false;
            }
        }

        /**
         * @param $email
         */
        public function emailCheck($email) {
           return $this ->valueCheck('email', 'staff', $email);
        }


        public function staffSearch($search){
            return $this ->customQuery("SELECT * FROM staff WHERE  name LIKE '%$search%' OR cell LIKE '%$search%'");
        }




    }

<?php

    namespace Ura\Dhura\Controller;

    use Ura\Dhura\Support\Database;


    /**
     * Class Student
     * @package Ura\Dhura\Controller
     */

    class Student extends Database {

        /**
         * Student Data Create
         * @return string
         */
        public function studentTomiJao($name, $email, $cell, $uname ) {

            $data = $this ->create("INSERT INTO students (name, email, cell, uname) VALUES ('$name','$email','$cell','$uname')");

            if($data){
                return '<p class="alert alert-success">Student created successful ! <button class="close" data-dismiss="alert">&times;</button></p>';
            }
        }


        /**
         * Get all students
         */
        public function sobDataNeyaAsoo() {

            $data = $this ->all('students');

            return $data ;

        }

        /**
         * Student Delete
         * @param $id
         */
        public function dhngsoooHow($id){
            $data = $this ->delete('students', $id);

            if( $data ){
                return '<p class="alert alert-success">Student deleted successful ! <button class="close" data-dismiss="alert">&times;</button></p>';
            }
        }

        /**
         * Find single student
         * @param $id
         */
        public function singleStudent($id){
            $data = $this ->find('students', $id);

            return $data;
        }

        /**
         * @param $id
         */
        public function editStudentData($id){
           $data =  $this ->find('students', $id);

           return $data;
        }


        /**
         * @param $name
         * @param $email
         * @param $cell
         * @param $uname
         */
        public function updateStudentInfo($name, $email, $cell, $uname, $id ){
            $this ->update("UPDATE students SET name='$name', email='$email', cell='$cell', uname='$uname ' WHERE id='$id'");

            header("location:students.php");
        }


    }

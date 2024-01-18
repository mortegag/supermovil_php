<?php

session_start();

include('dbcon.php');

if (isset($_POST['update_user_profile'])) {

    $display_name = $_POST['diplay_name'];
    $phone = $_POST['phone'];
    $profile = $_FILES['profile']['name'];
    $random_no = rand(1111, 9999);
    $uid = $_SESSION['verified_user_id'];
    $user = $auth->getUser($uid);

    $new_image = $random_no.$profile;
    $old_image = $user->photoUrl;

    if($profile!=NULL)
    {
        $filename = 'uploads/'.$new_image;
    }
    else
    {
         $filename = $old_image;
    }
       
 
    $properties = [
        'displayName' => $display_name,
        'phoneNumber' => $phone,
        'photoUrl'  => $filename,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if($updatedUser)
    {
        if($profile != NULL)
        {
            move_uploaded_file($_FILES['profile']['tmp_name'], "uploads/".$new_image);
            if($old_image != NULL)
            {
                unlink($old_image);
            }
        }
        $_SESSION['status'] = "User Profile Update";
        header("location: my-profile.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "User Profile NOT Update";
        header("location: my-profile.php");
        exit(0);
    }

}



if (isset($_POST['user_claims_btn'])) 
{
    $uid = $_POST['claims_user_id'];
    $roles = $_POST['role_as'];

    if($roles=='admin')
    {
        $auth->setCustomUserClaims($uid, ['admin' => true]);
        $msg = "user Role as Admin";
    }
    elseif($roles=='super_admin')
    {
        $auth->setCustomUserClaims($uid, ['super_admin' => true]);
        $msg = "user Role as Super Admin";
    } 
    elseif ($roles == 'norole') 
    {
        $auth->setCustomUserClaims($uid, null);
        $msg = "user Role is Removed";
    }

    if ($msg) {
        $_SESSION['status'] = "Password Update";
        header("Location: user-edit.php?id=$uid");
        exit();
    } else {
        $_SESSION['status'] = "Password Not Update";
        header("Location: user-edit.php?id=$uid");
        exit();
    }


}

if (isset($_POST['change_password_btn'])) {
    $new_password = $_POST['new_password'];
    $retype_password = $_POST['retype_password'];
    $uid = $_POST['change_pwd_user_id'];

    if ($new_password == $retype_password) {
        $updatedUser = $auth->changeUserPassword($uid, $new_password);
        if ($updatedUser) {
            $_SESSION['status'] = "Password Update";
            header('Location: user-list.php');
            exit();
        } else {
            $_SESSION['status'] = "Password Not Update";
            header('location: user_list.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "New password and Retype pwd does not match";
        header("Location: user-edit.php?id=$uid");
        exit();
    }

}

if (isset($_POST['enable_disable_user_ac'])) {
    $disable_enable = $_POST['select_enable_disable'];
    $uid = $_POST['ena_dis_user_id'];
    if ($disable_enable == "disable") {
        $updatedUser = $auth->disableUser($uid);
        $msg = "Account Disable";
    } else {
        $updatedUser = $auth->enableUser($uid);
        $msg = "Account Enabled";
    }

    if ($updatedUser) {
        $_SESSION['status'] = $msg;
        header('Location: user-list.php');
        exit();
    } else {
        $_SESSION['status'] = "Something Went Wrong ";
        header('Location: user_list.php');
        exit();
    }


}

if (isset($_POST['reg_user_delete_btn'])) {
    $uid = $_POST['reg_user_delete_btn'];

    try {
        $auth->deleteUser($uid);
        $_SESSION['status'] = "User Delete Successfully";
        header('Location: user-list.php');
        exit();

    } catch (Exception $e) {
        $_SESSION['status'] = "No Id Found";
        header('Location: user-list.php');
        exit();
    }


}


if (isset($_POST['update_user_btn'])) {
    $displayname = $_POST['display_name'];
    $phone = $_POST['phone'];

    $uid = $_POST['user_id'];
    $properties = [
        'displayName' => $displayname,
        'phoneNumber' => $phone,
    ];

    $updatedUser = $auth->updateUser($uid, $properties);

    if ($updatedUser) {
        $_SESSION['status'] = "User Update Successfully";
        header('Location: user-list.php');
        exit();
    } else {
        $_SESSION['status'] = "User Not Update ";
        header('Location: user-list.php');
        exit();
    }

}

if (isset($_POST['register_btn'])) {

    $fullname = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'phoneNumber' => '+507' . $phone,
        'password' => $password,
        'displayName' => $fullname,

    ];

    $createdUser = $auth->createUser($userProperties);

    if ($createdUser) {
        $_SESSION['status'] = "User created/Registered Successfully";
        header('location: register.php');
        exit();
    } else {
        $_SESSION['status'] = "User Not created/Registered ";
        header('location: register.php');
        exit();
    }


}






if (isset($_POST['delete_btn'])) {

    $del_id = $_POST['delete_btn'];
    $ref_table = 'contacts/' . $del_id;
    $deletequery_result = $database->getReference($ref_table)->remove();

    if ($deletequery_result) {
        $_SESSION['status'] = "Contact Delete Successfully";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "Contact Not Delete";
        header('location: index.php');
    }

}


//

if (isset($_POST['update_driver'])) {

    $key = $_POST['key'];
    $name = $_POST['name'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $vehicleBrand = $_POST['vehicleBrand'];
    $vehiclePlate = $_POST['vehiclePlate'];
    $rupv = $_POST['rupv'];
    $phone = $_POST['phone'];
    $enable = $_POST['enable'];


    $updateData = [
        'name' => $name,
        'cedula' => $cedula,
        'email' => $email,
        'vehicleBrand' => $vehicleBrand,
        'vehiclePlate' => $vehiclePlate,
        'rupv' => $rupv,
        'phone' => $phone,
        'enable' => $enable,

    ];

    $ref_table = 'Users/Drivers/'.$key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);


    if ($updatequery_result) {
        $_SESSION['status'] = "Driver Updated Successfully";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "Driver Not Update";
        header('location: index.php');
    }


}

//



if (isset($_POST['update_contact'])) {
    $key = $_POST['key'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $updateData = [
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'phone' => $phone,

    ];

    $ref_table = 'contacts/' . $key;
    $updatequery_result = $database->getReference($ref_table)->update($updateData);


    if ($updatequery_result) {
        $_SESSION['status'] = "Contact Updated Successfully";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "Contact Not Update";
        header('location: index.php');
    }


}


if (isset($_POST['save_contact'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $postData = [
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'phone' => $phone,

    ];

    $ref_table = "contacts";
    $postRef_result = $database->getReference($ref_table)->push($postData);


    if ($postRef_result) {
        $_SESSION['status'] = "Contact Added Successfully";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "Contact Not Added";
        header('location: index.php');
    }

}

?>

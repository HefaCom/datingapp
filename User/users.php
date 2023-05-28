<?php


if ($res) {
                    
    // echo $row['email'];

    while ($row = mysqli_fetch_assoc($res)) {
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dob = $row['dob'];
        $address = $row['address'];
        $password = $row['password'];
        $gender = $row['gender'];
        $id = $row['ID'];
        
        echo '<tr>
    <th scope="row">'.$id.'</th>
    <td>'.$name.'</td>
    <td>'.$email.'</td>
    <td>'.$phone.'</td>
    <td>'.$gender.'</td>
    <td>'.$dob.'</td>
    <td>'.$address.'</td>
    <td>'.$password.'</td>
    <td>
    <button  class = "btn btn-success "><a class = "text-light" href="update.php? updateid='.$id.'">Update</a></button>
    <button class = "btn btn-danger "><a class = "text-light" href="delete.php? deleteid='.$id.'">Delete</a></button>
    </td>
</tr>';
    }
}
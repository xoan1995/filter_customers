<?php
$customer_list = array(
    "1" => array("name" => "Hoàng Nhật Linh", "date_of_birth" => "1995/08/03", "address" => "Hòa Bình", "profile" => "img/img1.jpg"),
    "2" => array("name" => "Nguyễn Thái An", "date_of_birth" => "1994/03/03", "address" => "Hòa Bình", "profile" => "img/img1.jpg"),
    "3" => array("name" => "Hoàng Thị Thân", "date_of_birth" => "1968/05/19", "address" => "Hòa Bình", "profile" => "img/img1.jpg"),
    "4" => array("name" => "Nguyễn Tiến Mạnh", "date_of_birth" => "1992/03/23", "address" => "Hà Nội", "profile" => "img/img1.jpg"),
    "5" => array("name" => "Nguyễn Thanh Hiền", "date_of_birth" => "1994/03/25", "address" => "Hòa Bình", "profile" => "img/img1.jpg")
);
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['date_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['date_of_birth']) < strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$from_date = NULL;
$to_date = NULL;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $from_date=$_POST['from'];
    $to_date=$_POST['to'];
}
$filtered_customers= searchByDate($customer_list, $from_date,$to_date);
?>
<form method="post">
    Từ: <input type="text" id="from" name="from" placeholder="yyyy/mm/dd" value="<?php echo isset($from_date)?$from_date:'';?>"/>
    Đến: <input type="text" id="to" name="to" placeholder="yyyy/mm/dd" value="<?php echo isset($to_date)?$to_date:'';?>">
    <input type="submit" id="submit" value="Lọc">
</form>
<table border="1">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
        <?php foreach ($filtered_customers as $index => $customer):?>
    <tr>
        <td><?php echo $index+1;?></td>
        <td><?php echo $customer['name'];?></td>
        <td><?php echo $customer['date_of_birth'];?></td>
        <td><?php echo $customer['address'];?></td>
        <td><div class="profile"><img src="<?php echo $customer['profile'];?>"></div></td>
    </tr>
        <?php endforeach;?>
</table>

</body>
</html>

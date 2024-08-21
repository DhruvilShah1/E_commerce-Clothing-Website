<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
<section id="tables" class="section-p1">
    <h2>User's Query</h2>
        <table width="100%">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                 <td>Email</td>
                    <td>Number</td>
                   <td>Message</td>
                    <td>Time</td>
                </tr>
            </thead>
            <tbody>
            <?php
                include("connection.php");
                $query = "SELECT * FROM `contact_us`";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['c_id'] . '</td>';
                    echo '<td>' . $row['u_name'] . '</td>';
                    echo '<td>' . $row['u_number'] . '</td>';
                    echo '<td>$' . $row['u_email'] . '</td>';
                    echo '<td>$' . $row['u_message'] . '</td>';
                    echo '<td>$' . $row['timess'] . '</td>';
                   
                   
                }
                ?>
              </tbody>
</table>
</section>

    <script>

    function deleteProduct(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'delete_user.php?i_id=' + userId; 
            }
        });
    }

    </script>
</body>
</html>
<style>
 #tables table{
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        white-space: nowrap;
    }
    #tables h2{
        text-align:center;
    }
    #tables table img{
        width: 100px;
    }
    #tables table{
        overflow-x: auto;
    }
    #tables table td{
        text-align: center;
    }
    
    #tables table tbody td:nth-child(1){
font-size: larger;

    }
    #tables table td:nth-child(5) input{
        width: 70px;
        padding: 10px 5px 10px 15px;
    }
    
    #tables table thead{
       border: 1px solid #e2e9e1;
       border-left: none;
       border-right: none;
    }
    #tables table thead td{
        font-weight: 700;
        text-transform: uppercase;
        padding: 18px 0;
        font-size: 12px;
    }
    #tables table tbody tr td{
        padding-top: 15px;
    }
    
.update-btn,
.delete-btn {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-right: 5px;
    transition: background-color 0.3s ease;
}

.update-btn {
    background-color: #28a745;
    color: white;
}

.update-btn:hover {
    background-color: #218838;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}

.delete-btn:hover {
    background-color: #c82333;
}

</style>
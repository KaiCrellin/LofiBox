<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: sans-serif;
        background-color: black;
        color: #eee;
        padding: 2rem;
        display: grid;
        justify-content: center;
        
    }


    h1 {
        display: flex;
        justify-content: center;
        background: beige;
        color: black;
        font-size: xx-large;
        border: 1px solid grey;
    }


    p {
        margin: 15px 15px 15px 15px;
        font-size: larger;
    }

    a {
        border: 2px solid white;
        border-radius: 2rem;
        padding: 1rem;
        background: blue;
        color: white;
        text-transform: capitalize;
        font-size: x-large;
        margin: 15px 15px 15px 15px;
        position: relative;
        text-decoration: none;
    }


    .wrapper-1 {
        border: 1px solid white;
        background: gray;
        display: flex;
        justify-content: center;
        padding: 1rem;
    }

    .wrapper-2 {
        border: 1px solid white;
        padding: 2rem;
        background-color: darkgray;

    }

    .bttn-nav {
        display: flex;
        justify-content: center;
    }

    


</style>



<body>
    <h1>LofiBox Home Page</h1>


    <div class="wrapper-1" >
        <p>This is a solo project, Made to store Lo-Fi tracks that you enjoy.</p>
    </div>

    <div class="wrapper-2" >
        <div class="bttn-nav" id="Buttons">
            <a href="login.php">Log In</a>
            <a href="register.php">Register Account</a>
        </div>
    </div>

</body>

</html>
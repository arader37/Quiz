<?php include('header.php'); ?>

<html>
    <head>
        <title>QuizMaster Home Page</title>
    </head>
    <style>
        .image {
            width: 100px;
            height: 100px;
            padding: 20px 20px 20px 20px;
            transition: transform .2s;
        }
        .image:hover {
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }
        #silc {
            width: 300;
            height: 85;
        }
        #welcome {
            text-align: center;
        }
        #directions {
            text-align: center;
        }
        #title {    
            color: black;        
            text-align: center;
        }
        a:visited, a:link, a:active {
            text-decoration: none;
        }
    </style>
    <body>
    <br><br><br><br><br>
    <h1 id = "welcome">Welcome to QuizMaster</h1>
    <h2 id = "directions">Select a topic to test your knowledge about India</h2>
    <table id = "table_2">
        <!--Links to quizzes can be put inside the href = ""-->
        <tr>
            <td>
                <a href = "dresses_quiz.html" title = "Dresses">
                    <image class = "image" src = "Images/index_images/dresses_and_costumes.png"></image>
                    <div id = "title">Dresses</div>
                </a>
            </td>

            <td>
                <a href = "dances_quiz.html" title = "Dances">
                    <image class = "image" src = "Images/index_images/dances.jpg"></image>
                    <div id = "title">Dances</div>
                </a>
            </td>

            <td>
                <a href = "festivals_quiz.html" title = "Festivals">
                    <image class = "image" src = "Images/index_images/festivals.png"></image>
                    <div id = "title">Festivals</div>
                </a> 
            </td>   

            <td>
                <a href = "food_quiz.html" title = "Foods">
                    <image class = "image" src = "Images/index_images/foods.png"></image>
                    <div id = "title">Foods</div>
                </a>
            </td>

            <td>
                <a href = "" title = "Geography">
                    <image class = "image" src = "Images/index_images/geography.png"></image>
                    <div id = "title" style="color:red" >Geography</div>
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <a href = "leaders_n_scientists_quiz.html"  title = "Leaders and Scientists">
                    <image class = "image" src = "Images/index_images/leaders_and_scientists.png"></image>
                    <div id = "title">Scientists</div>
                </a>
            </td>

            <td>
                <a href = "movies_quiz.html"  title = "Movies">
                    <image class = "image" src = "Images/index_images/movies.png"></image>
                    <div id = "title">Movies</div>
                </a>
            </td>

            <td>
                <a href = "instruments_quiz.html"  title = "Musical Instruments">
                    <image class = "image" src = "Images/index_images/musical_instruments.png"></image>
                    <div id = "title">Instruments</div>
                </a>
            </td> 

            <td>
                <a href = "nris_quiz.html"  title = "NRI's">
                    <image class = "image" src = "Images/index_images/NRI's.jpg"></image>
                    <div id = "title">NRI's</div>
                </a>
            </td>

            <td>
                <a href = "monuments_quiz.html"  title = "Places and Monuments">
                    <image class = "image" src = "Images/index_images/places_and_monuments.png"></image>
                    <div id = "title">Monuments</div>
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <a href = "sports_quiz.html"  title = "Sports">
                    <image class = "image" src = "Images/index_images/sports.png"></image>
                    <div id = "title">Sports</div>
                </a>
            </td>

            <td>
                <a href = "states_quiz.html"  title = "States">
                    <image class = "image" src = "Images/index_images/states.png"></image>
                    <div id = "title">States</div>
                </a>
            </td>

            <td>
                <a href = "symbols_quiz.html"  title = "Symbols">
                    <image class = "image" src = "Images/index_images/symbols_of_india.png"></image>
                    <div id = "title">Symbols</div>
                </a>
            </td>
            <td>
                <a href = "embroidery_quiz.html"  title = "Traditional Games">
                    <image class = "image" src = "Images/index_images/embroidery.png"></image>
                    <div id = "title">Embroidery</div>
                </a>
            </td>

            <td>
                <a href = ""  title = "Yoga">
                    <image class = "image" src = "Images/index_images/yoga.png"></image>
                    <div id = "title"  style="color:red">Yoga</div>
                </a>
            </td>
        </tr>
    </table>
    </body>
</html>

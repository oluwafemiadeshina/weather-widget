<!DOCTYPE html>
<html>
<head>
<title>Weather Report Widget</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Custom Theme files -->
<link href="css/main.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- js -->
<script src="./js/jquery-2.2.3.min.js"></script> 
</head>
<body>
          <?php 
            $temp=0;
            $name='Location';
            $humidity=0;
            $description='description';
            $pressure=0;
            $sea_level=0;
            $visibility=0;
            $speed=0;
            $speed=0;
            $grnd_level=0;
    if(isset($_POST['search'])){
        
         $query=$_POST['location'];
        //this  api is for joba an dhas to changed asap.
        $url = 'api.openweathermap.org/data/2.5/weather?q='.$query.'&appid=26d8fbc12d93348b6e75fa2ab3ce67d0&units=metric';
        $cur = curl_init($url);
        curl_setopt($cur, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cur, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cur, CURLOPT_URL,$url);
        $data = curl_exec($cur);
        $response = json_decode($data,true);

            
        
        curl_close($cur);
//        var_dump($response);
        $location=$_POST['location'];
        $location = filter_var($location, FILTER_SANITIZE_STRING);
        
        
        if($location=''){
            echo '<div class="text-white text-center">Enter a location</div>';
        }elseif($response['cod']==404){
            echo '<div class="text-white text-center">Location doesn\'t exist</div>';
        }else{
                isset($response['name'])?$name=$response['name']:$name='Location';       
                isset($response['main']['temp'])?$temp=$response['main']['temp']:$temp='--';       
                isset($response['visibility'])?$visibility=$response['visibility']:$visibility='--';       
                isset($response['weather'][0]['description'])?$description=$response['weather'][0]['description']:$description='--';       
                isset($response['main']['humidity'])?$humidity=$response['main']['humidity']:$humidity='--';       
                isset($response['main']['pressure'])?$pressure=$response['main']['pressure']:$pressure='--'; 
                isset($response['main']['sea_level'])?$sea_level=$response['main']['sea_level']:$sea_level='null';
                isset($response['wind']['speed'])?$speed=$response['wind']['speed']:$speed='--';       
                isset($response['main']['grnd_level'])?$grnd_level=$response['main']['grnd_level']:$grnd_level='--';       
        }    
    }
            ?>
    <div class="text-white text-center" style="display:none;" id="network">There was a network error. Please check your internet connection.</div>
    <div class="main-div">
        <h1 class="text-center text-white fw">My weather App</h1>
        		<div class="container">
					<form action="index.php" class="find-location" method="post">
						<input type="text" placeholder="Find your location..." name="location">
						<input type="submit" value="Find" name="search">
					</form>
				</div>
        <div class="main_row">
            <div>
                	<p class="day text-center text-white"><?= date('D')?>day</p>
                	<p class="date text-center"><?= date('d M Y')?></p>
            </div>
            <div class="text-center">
                <h2><?= round($temp);?><span>°C</span></h2>
            </div>
            <div class="text-center text-white">
                <h4><?= $name;?></h4>&nbsp;<img src="./images/icons/icon-1.svg">
                <p><?= $description;?></p><br><!--    description-->
               

            </div>
<!--            <div style="display: none;">-->
            <div class="text-white">
                <p class="text-white"><strong>Current details</strong></p><hr>
                <div class="row">
                    <div class="">
                        <div class="inline"><p class="fl">Humidity</p></div>
                        <div class="inline"><p class="fl">Visibility</p></div>
                        <div class="inline"><p class="fl">Pressure</p></div>
                        <div class="inline"><p class="fl">Sea level</p></div>
                        <div class="inline"><p class="fl">Speed of wind</p></div>
                        <div class="inline"><p class="fl">Ground level</p></div>
                    </div>
                    <div class=""> 
                        <p><span><?= $humidity;?>%</span></p>
                        <p><span><?= $visibility;?><sup>o</sup>C</span></p>
                        <p><span><?= $pressure;?> mBar</span></p>
                        <p><span><?= $sea_level;?> </span></p>
                        <p><span><?= $speed;?> km/h</span></p>
                        <p><span><?= $grnd_level;?> m</span></p>
                </div>
                </div>
                
                
            </div>
        </div>
    </div>

    
    <footer>
    <p class="text-center text-white">© 2019 All Rights Reserved.</p></footer>
    <script>
    // this detects if the browser is offline 
    var x =  navigator.onLine;
        if(x==false){
            $('#network').show();
            alert('There was a network error. Please check your internet connection.');
        }else{

        }
    </script>
</body>
</html>
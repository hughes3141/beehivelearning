<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
      Beehive Learning
    </title>
    <meta name="description" content="Resources to support studnet-led learning" />
    <meta name="keywords" content="" />
    <meta name="author" content="Ryan Hughes" />


    <!-- Use below for development
    

    <script src="https://cdn.tailwindcss.com"></script>
   --> 
    <link rel="stylesheet" href="/dist/output.css"/>
      


    <!--Replace with your tailwind.css once created-->


    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />

    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
      .gradient {
        background: linear-gradient(90deg, #22D3EE 0%, #FCD34D 100%);
        /*
        Trying different theme colors: 
          amber-300: #FCD34D
          cyan-400: #22D3EE

          blue-400 = #60A5FA
          yellow-400: #FACC15
          lime-400: #A3E635
          #FDE047
          #FACC15
        */
      }

      <?php echo $style_input;?>

    </style>
  </head>
  <body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
          <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl font-mono" href="#">
            
          <svg class="h-8 fill-current inline" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
              <!-- 
                This is using #6b7280 which is gray-500
              -->
              <path style="fill:rgb(255 255 255 / var(--tw-text-opacity));stroke-width:2;stroke:#6b7280"  d="M508.203,197.698L435.2,149.03V59.731c0-2.995-1.579-5.769-4.139-7.313l-85.333-51.2c-2.705-1.621-6.084-1.621-8.789,0 L256,49.781L175.061,1.218c-2.705-1.621-6.084-1.621-8.789,0l-85.333,51.2c-2.56,1.544-4.139,4.318-4.139,7.313v89.3L3.797,197.7 C1.425,199.287,0,201.949,0,204.8v102.4c0,2.859,1.425,5.521,3.797,7.1L76.8,362.968v89.297c0,2.995,1.579,5.777,4.139,7.322 l85.333,51.2c1.357,0.811,2.876,1.212,4.395,1.212s3.038-0.401,4.395-1.212L256,462.223l80.939,48.563 c1.357,0.811,2.876,1.212,4.395,1.212c1.519,0,3.038-0.401,4.395-1.212l85.333-51.2c2.56-1.545,4.139-4.326,4.139-7.322v-89.298 l73.003-48.668c2.372-1.579,3.797-4.241,3.797-7.1v-102.4C512,201.948,510.575,199.285,508.203,197.698z M256,348.448 l-62.352-37.411l-14.448-8.669v-92.732l0.42-0.252L256,163.556l76.38,45.828l0.42,0.252v92.732l-14.448,8.669L256,348.448z M341.333,18.481l76.8,46.089v84.198l-76.8,46.08l-76.8-46.08V64.57L341.333,18.481z M93.867,64.57l76.8-46.089l76.8,46.089 v84.198l-76.8,46.08l-76.8-46.08V64.57z M17.067,209.365l68.502-45.668l57.07,34.242l19.495,11.699v92.73l-74.422,44.653 l-2.139,1.283l-68.506-45.67V209.365z M170.667,493.515l-76.8-46.08v-84.197l76.801-46.081l76.799,46.079v84.198L170.667,493.515z M341.333,493.515l-76.8-46.08v-84.198l76.8-46.08l76.8,46.08v84.198L341.333,493.515z M494.933,302.633l-68.506,45.67 l-76.066-45.638l-0.495-0.297v-92.732l76.561-45.935l68.506,45.67V302.633z"/>
            </g>
           
          </svg>
          
          <!--Icon from: http://www.potlabicons.com/ -->

            <!--
            <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.005 512.005">
              <rect fill="#2a2a31" x="16.539" y="425.626" width="479.767" height="50.502" transform="matrix(1,0,0,1,0,0)" />
              <path
                class="plane-take-off"
                d=" M 510.7 189.151 C 505.271 168.95 484.565 156.956 464.365 162.385 L 330.156 198.367 L 155.924 35.878 L 107.19 49.008 L 211.729 230.183 L 86.232 263.767 L 36.614 224.754 L 0 234.603 L 45.957 314.27 L 65.274 347.727 L 105.802 336.869 L 240.011 300.886 L 349.726 271.469 L 483.935 235.486 C 504.134 230.057 516.129 209.352 510.7 189.151 Z "
              />
            </svg>
            -->
            Beehive Learning
          </a>
        </div>
        <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 text-cyan-800 hover:text-gray-500 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
              <a class="inline-block py-2 px-4 text-black font-bold no-underline" href="#">Active</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">link</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="#">link</a>
            </li>
          </ul>
          <button
            id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
            class="flex items-center mx-auto lg:mx-0 hover:underline bg-pink-200 lg:bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
          >
            Action
          </button>
          <div id="dropdownNavbar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-800 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-800 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="/user/user3.0.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                  </li>
                  <!--
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                  </li>
                  
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                  </li>
                  -->
                </ul>
                <div class="py-1">
                  <a href="/signout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Sign out</a>
                </div>
            </div>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
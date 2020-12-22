<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased  bg-gray-100">
        <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                    <button color="blue" class="px-6 py-4 bg-green-600 rounded:sm">
                        <a href="{{ route('login') }}" class="text-sm text-green-700">Login</a>
                    </button>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>

    <!-- hero -->
    <div class=" max-w-64 bg-gray-100 py-16 mx-6">
        <!-- container -->
        <div class="container px-4">
            <!-- hero wrapper -->
            <div class="items-center">


                    <h1 class=" font-bold text-4xl text-gray-900 text-center">Online Examination System</h1>
                    <p class="text-center text-gray-800 mt-8 font-semibold">Take Online test in any subject more easily</p>


                <div >
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"><title>Quiz app designed by Blavo</title><path d="M81.77,83.39c-28.67,17.47-45.66,49.51-43,83C40.18,183.48,46.54,200,63.35,209c44.83,24,240.55,24.45,269.51-18s18.19-102.84-44.8-128C233.46,41.18,155.82,38.3,81.77,83.39Z" fill="#e6e6e6" opacity="0.3"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#ffd200" stroke-miterlimit="10" stroke-width="2"/><path d="M283.69,206V180.64a4.65,4.65,0,0,1,4.64-4.65h18.49a4.65,4.65,0,0,1,4.64,4.65V206" fill="none" stroke="#000" stroke-miterlimit="10" stroke-width="2" opacity="0.08"/><path d="M159.26,145.74s-18.34,7.36-12.41,28.68,6.48,23.63,19.71,22.32,4.66-22.32,4.66-22.32Z" fill="#ffd200"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#ed8936"/><path d="M152.37,79.92s-50.86,11.79-64.24,41.59l45.05,3.4,11.54-7Z" fill="#fff" opacity="0.46"/><ellipse cx="200.42" cy="272.36" rx="154.08" ry="11.83" fill="#e6e6e6" opacity="0.45"/><path d="M134.79,246.33s-4.45,3.22-8.54.91-7.67.77-4.87,4.13,14.8,5,14.8,5l4.51-7.28Z" fill="#ed8936"/><path d="M215.08,260.56s1.94,5.15,6.62,5.47,6,4.88,1.79,6.14-15.12-4-15.12-4l.26-8.57Z" fill="#ed8936"/><path d="M79.19,260.08s-10.59-2.9-12.89-12.75c0,0,16.41-3.32,16.87,13.62Z" fill="#ed8936" opacity="0.58"/><path d="M80.49,259s-7.4-11.7-.89-22.64c0,0,12.48,7.93,6.93,22.66Z" fill="#ed8936" opacity="0.73"/><path d="M82.4,259s3.9-12.35,15.72-14.69c0,0,2.21,8-7.65,14.73Z" fill="#ed8936"/><polygon points="74.72 258.75 76.86 273.44 90.38 273.5 92.37 258.83 74.72 258.75" fill="#24285b"/><path d="M156.2,53.77s1.74,6.3,4.27,10a3.28,3.28,0,0,0,4.58.82c1.83-1.3,3.93-3.59,3.41-7.08l-.15-6a5.88,5.88,0,0,0-4.6-5C159.34,45.28,155,50,156.2,53.77Z" fill="#f4a28c"/><polygon points="169.43 54.63 177.9 74.3 166.73 78.19 165.05 62.32 169.43 54.63" fill="#f4a28c"/><path d="M170.86,55.92h0a.62.62,0,0,1-.23.72,4.34,4.34,0,0,1-5.25-.1,5.45,5.45,0,0,1-2.08-5.6,25.94,25.94,0,0,1-5.48,2.52,6,6,0,0,1-2,.32l-3.28-4s-4.23-3.66-1.89-5.67,4.76.61,6.11-2.44,1.54-4.07,4.27-3.72.83,3.12,4.53,1.7,4.36.08,5,1.75a3.1,3.1,0,0,1-.12,1.82A20.1,20.1,0,0,0,170.86,55.92Z" fill="#24285b"/><path d="M164.66,56.6s-.83-2.37,1-2.85,3.06,3,.77,4.16Z" fill="#f4a28c"/><path d="M157.5,57.68l-.83,3A1,1,0,0,0,157.85,62l2.51-.43Z" fill="#f4a28c"/><rect x="289.35" y="173.73" width="16.36" height="5.3" fill="#24285b"/><path d="M165.31,64.43s1.44-.49,3.72-3.33c0,0,1.05,4.15-3.26,8Z" fill="#ce8172" opacity="0.31"/><path d="M162.12,76.62l6.43-1.16a90.83,90.83,0,0,0,8.92-2.08c11-3.14,43.37-10.53,52.58,8.2,11.16,22.69-7.47,96.3-7.47,96.3h-51s-10.41-30.66-25.29-49.62S121,88.21,162.12,76.62Z" fill="#ed8936"/><path d="M152.37,79.92s-2.56,16.32,19.86,4l-5.75-8A58,58,0,0,0,152.37,79.92Z" opacity="0.08"/><path d="M94.92,139.7c-10.16-3.16-11.68-17-2.47-22.37a25.2,25.2,0,0,1,10.9-3.2c17.08-1.26,46.18-2.85,46.18-2.85s17.52,5.7,14.77,14.24-15.08-5.06-15.08-5.06S116.66,146.46,94.92,139.7Z" fill="#f4a28c"/><rect x="144.58" y="110.56" width="6.04" height="12.3" transform="translate(-14.69 21.47) rotate(-7.93)" fill="#24285b"/><rect x="143.84" y="109.5" width="6.04" height="3.82" transform="matrix(0.99, -0.14, 0.14, 0.99, -13.96, 21.32)" fill="#ffd200"/><path d="M166.48,75.84s-7.76,7.14,1.21,8.67,9.78-11.13,9.78-11.13Z" fill="#f4a28c"/><path d="M171.63,177.88l-38.45,68.45,9.93,6.91s21.24-35.45,46.53-53.26a6.38,6.38,0,0,1,9.72,3.27c6.84,21.15,7.42,58,7.42,58H218.5l4.08-83.34Z" fill="#24285b"/><path d="M171.63,177.88s19.15-15,25.92-36.41a6.57,6.57,0,0,1,11.08-2.37l18.2,19.68,3.67-20.57L217.19,96.09,192,79.92l-5,19.51Z" opacity="0.08"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#ffd200"/><path d="M163.36,158.94s11.81-11.72,14.11-50.86c1.91-32.56,6.58-38.92,16.33-41.2,15.06-3.54,18.65.94,23.39,7.63,0,0-24.08,1.49-23.24,16.56s-2.51,68.75-22.32,86.81C171.63,177.88,162.44,177.11,163.36,158.94Z" fill="#fff" opacity="0.46"/><path d="M196.37,93.76c-5-12,8.93-27.14,21-22.46,10.32,4,21.35,12.84,27.34,30.64C258.94,144.25,291,164.7,291,164.7s16.36,2.7,16.36,8.65-19.34,0-19.34,0-50.2-20.83-76.24-54.3C204,109,199.22,100.59,196.37,93.76Z" fill="#f4a28c"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#ed8936"/><path d="M226.35,134.56s19.94-6.75,25-16.62c0,0-7.22-38.91-32.87-47.28-8.44-2.75-17.87.34-22.29,8C190.83,88,192,105.22,226.35,134.56Z" fill="#fff" opacity="0.46"/><rect x="271.49" y="198.46" width="52.16" height="67.53" fill="#ffd200"/><rect x="278.47" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="309.43" y="265.99" width="6.37" height="6.37" fill="#24285b"/><rect x="280.14" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="293.95" y="211.01" width="7.25" height="40.35" opacity="0.08"/><rect x="306.92" y="211.01" width="7.25" height="40.35" opacity="0.08"/><circle cx="222.58" cy="34.77" r="21.04" fill="#24285b"/><polygon points="214.44 34.77 196.44 52.7 220.3 43.18 214.44 34.77" fill="#24285b"/><rect x="220.3" y="25.3" width="3.51" height="11.08" fill="#fff"/><rect x="220.3" y="39.43" width="3.51" height="3.51" fill="#fff"/></svg>
                </div>
            </div>
        </div>
    </div><!-- end hero -->



    </body>
</html>

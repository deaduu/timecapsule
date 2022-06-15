@extends('pages.layout.body')

@section('body')

<style>
    /* Container */

    .container {
        background-color: #f4f4f4;
        padding: 40px;
        text-align: center;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 500px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
    }

    .container h1 {
        margin: 2rem 0;
    }

    .container input {
        padding: 10px;
        border-radius: 10px;
        margin: 1rem 1rem;
        text-align: center;
    }

    .container .input,
    .container .button,
    .container .output {
        margin: 2rem 0;
    }

    p {
        font-size: 2rem;
    }

    .time-labels p {
        margin: 0.5rem 0.7rem;
        display: inline-block;
        font-size: 0.8rem;
    }

    /* Error Message */

    .error {
        background-color: #FF7979;
        color: #fff;
        margin: 2rem 0;
        padding: 10px;
        border-radius: 10px;
    }

    /* Responsive */

    @media (max-width: 768px) {
        .container {
            width: 300px;
        }
    }
</style>
<div class="antialiased">

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">

                <img src="{{asset('logo/TimeCapsule-logos_transparent.png')}}" alt="" class="h-16 w-auto text-gray-700 sm:h-20">
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid">
                    <div id="messageArea" class="alert alert-success">
                        <div class="container">
                            <div class="icon"><i class="fa-solid fa-clock fa-3x"></i></div>
                            <h1 id="heading">Countdown</h1>

                            <div class="output">
                                <div class="time-labels">
                                    <p>Days</p>
                                    <p>Hours</p>
                                    <p>Mins</p>
                                    <p>Secs</p>
                                </div>
                                <p id="output"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>

<script>
    const countDownDate = date;

    // EVENT LISTENERS
    function daterun() {

        let userTime = new Date(countDownDate).getTime();

        // User input validation
        if (countDownDate.value != '') {
            // Update count every second
            const x = setInterval(function() {

                // Get today's date and time
                const now = new Date().getTime();

                // Get distance between now and countdown date
                const distance = userTime - now;

                // Time calc
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display result
                document.getElementById('output').innerHTML = `<div>  ${days}   :   ${hours}   :    ${minutes}    :    ${seconds}</div>`;


                // Countdown finished text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById('output').innerHTML = 'It\'s time!';

                    location.reload();
                }
            }, 1000);

        } else {
            showError('Please check your date.');
        }
    }

    daterun();
</script>

@endsection
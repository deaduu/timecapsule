<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Etimecap</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{asset('ckeditor5/style.css')}}">

    <style>
        .Preview {
            background-color: #31B0D5;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            border-color: #46b8da;
        }

        #previewbutton {
            position: fixed;
            bottom: -4px;
            right: 10px;
        }

        /* for submit popup */

        .cursor-pointer {
            cursor: pointer;
            color: #42A5F5;
        }

        .pic {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .card-block {
            width: 200px;
            border: 1px solid lightgrey;
            border-radius: 5px !important;
            background-color: #FAFAFA;
            margin-bottom: 30px;
        }

        .card-body.show {
            display: block;
        }

        .card {
            padding-bottom: 20px;
            box-shadow: 2px 2px 6px 0px rgb(200, 167, 216);
        }

        .radio {
            display: inline-block;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            color: #000;
            font-weight: 500;
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            filter: grayscale(100%);
        }


        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .radio.selected {
            box-shadow: 0px 8px 16px 0px #EEEEEE;
            -webkit-filter: grayscale(0%);
            -moz-filter: grayscale(0%);
            -o-filter: grayscale(0%);
            -ms-filter: grayscale(0%);
            filter: grayscale(0%);
        }

        .selected {
            background-color: #E0F2F1;
        }

        /* .ck-editor__editable_inline {
            min-height: 300px;
        } */
    </style>

    @if(isset($page) AND $page == 'timer')
    <script>
        const date = '{{$date}}';
    </script>
    @endif
</head>

<body>
    @yield('body')

    @if(!isset($page))
    <div id="previewbutton">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
            EDIT
        </button>

        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#formsub">
            SAVE
        </button>
    </div>
    <!-- Modal For Edit -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class=" modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Enter Your Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="grid">
                        <div id="message"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges"
                        data-bs-dismiss="modal">Preview</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal For Submit -->
    <div class="modal fade" id="formsub" tabindex="-1" aria-labelledby="formsubLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class=" modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="formsubLabel">Submit Your Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">

                    <div class="card text-center justify-content-center shaodw-lg  card-1 border-0 bg-white px-sm-2"
                        id="step1">
                        <div class="card-body show">
                            <div class="row">
                                <div class="col">
                                    <h5><b>Choose Message Type</b></h5>
                                    {{-- <p> What are you reporting ? <span class=" ml-1 cursor-pointer"> Learn more</span> --}}
                                    </p>
                                </div>
                            </div>
                            <div class="radio-group row justify-content-between px-3 text-center a">
                                <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected "
                                    id="mebox">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid"
                                                    src="{{asset('logo/myself.png')}}" width="100" height="100">
                                            </div>
                                            <p>For Myself</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto ml-sm-2 mx-1 card-block  py-0 text-center radio  " id="someonebox">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid"
                                                    src="{{asset('logo/someone.png')}}" width="100" height="100">
                                            </div>
                                            <p>For Someone Special</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio " id="linkbox">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid"
                                                    src="{{asset('logo/link.png')}}" width="100" height="100">
                                            </div>
                                            <p>Generate Shareable Link</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col">
                                    <p class="text-muted" id="descBox">Craft a personal message to your future self,
                                        preserving thoughts and reflections for the journey ahead</p>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">
                                        <span class="mr-2"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                        Back</button>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-primary" onclick="stepTwo()">Continue <span
                                            class="ml-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card justify-content-center shadow-lg card-1 border-0 bg-white px-sm-2 d-none"
                        id="step2">
                        <div class="card-body">
                            <form action="" method="post" id="detailForm" class="row g-3">
                                <input type="hidden" name="message_for" id="message_for" value="me">

                                <!-- Details for Me -->
                                <div class="col-md-6" id="detailsForMe">
                                    <label for="from_email" class="form-label">Your Email Address</label>
                                    <input type="email" class="form-control" id="from_email" required>

                                    <label for="from_contactno" class="form-label mt-3">Your Mobile Number
                                        (Optional)</label>
                                    <input type="number" class="form-control" id="from_contactno">
                                </div>

                                <!-- Details for Someone -->
                                <div class="col-md-6 d-none" id="detailsForSomeone">
                                    <label for="to_email" class="form-label">Recipient's Email Address</label>
                                    <input type="email" class="form-control" id="to_email">

                                    <label for="to_contactno" class="form-label mt-3">Recipient's Mobile Number</label>
                                    <input type="number" class="form-control" id="to_contactno">
                                </div>

                                <!-- Message Data -->
                                <div class="col-md-6">
                                    <label for="datepicker" class="form-label">Select the Date for Message
                                        Delivery</label>
                                    <input type="text" id="datepicker" autocomplete="off" class="form-control" required>

                                    <label for="timepicker" class="form-label mt-3">Select the Time for Message
                                        Delivery</label>
                                    <input type="time" id="timepicker" autocomplete="off" class="form-control" required>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="col-md-12 mt-4">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-outline-secondary" onclick="stepOne()">
                                            <i class="fa fa-angle-left" aria-hidden="true"></i> Back
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Submit <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    @endif
</body>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@if(!isset($page))
{{-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script> --}}

<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>


<script>
    // Function to get a random message
 function getRandomMessage() {

    var messages = [
                        "Sow seeds of sentiment! Share a message for the future, whether it's for you or someone extraordinary.",
                        "Leave your mark on tomorrow! Type a message for yourself or a dear one, and let time reveal its story.",
                        "Whispers for the future! Enter a message for yourself or a cherished soul, awaiting its moment in time.",
                        "Messages bound for the future. Pen down thoughts for yourself or a special someone and watch them blossom over time.",
                        "Unlock the future with your words! Record a message for yourself or someone close, ready to unfold when the time is right.",
                        "Beyond the now, your message matters. Share a note for the future you or a significant other.",
                        "Future greetings start here! Compose a message for yourself or a loved one, a digital letter to the days ahead.",
                        "Time-crafted messages! Share your thoughts for the future, a personal note for yourself or someone extraordinary.",
                        "Inscribe the future with your words! Leave a message for yourself or a special person, a secret waiting to be unveiled over time.",
                        "Messages on a journey through time. Write a note for your future self or a cherished companion, and let time weave its tale.",
                        // Additional Messages
                        "Embark on a journey through time! Craft a message for your future self or a special someone right here.",
                        "Time capsule alert! Drop a message for your future or a cherished individual in this space.",
                        "Your words, their time to shine. Enter a message for yourself or someone dear, destined for the future.",
                        "Futures start with words. Share a message for yourself or a loved one and watch it bloom in time.",
                        "Messages that transcend time. Pour your thoughts for the future, whether for yourself or a special connection.",
                        "Gifts for the future! Write a message for yourself or someone special and let time reveal its magic.",
                        "Time-traveling messages await! Leave a note for the future you or a person close to your heart.",
                        "Beyond the present, your message awaits. Share words for the future you or a special someone.",
                        "Message in a digital bottle! Convey your thoughts for the future, destined to be opened with time.",
                        "Words echo through time. Pen a message for your future self or a cherished companion right here."
                        ];


            var randomIndex = Math.floor(Math.random() * messages.length);
            return messages[randomIndex];
        }
        
  ClassicEditor
      .create(document.querySelector('#message'))
      .then(editor => {
    //   editor.plugins.get( 'ClipboardPipeline' ); // -> An instance of the clipboard pipeline plugin.

        editor.setData(getRandomMessage());

           var message = editor.getData();

           $('#messageArea').html(message);


        $('#saveChanges').click(() => {
            var message = editor.getData();
            $('#messageArea').html(message);
        });


        $('#detailForm').submit((e) => {

        e.preventDefault();

        var message = editor.getData();
        var date = $('#datepicker').val();
        var from_email = $('#from_email').val();
        var to_email = $('#to_email').val();

            $.ajax({
                url: '/message',
                type: 'POST',
                data: {
                    'message': message,
                    '_token': '{{ csrf_token() }}',
                    'date': date,
                    'from_email': from_email,
                    'to_email': to_email
                },
                dataType: "json",
                success: (response) => {
                    window.location.href = `/${response.token}/${response.token_1}/${response.token_2}`;
                },
                error: (response) => {
                    console.log(response);
                }
            });
        });
      })
      .catch(error => {
         console.error(error);
      });

    

    $(document).ready(() => {

        $('#messageArea').click(function(){
            $('#EditModal').modal('toggle');
        });

         $('.radio-group .radio').click(function () {
            $('.selected .fa').removeClass('fa-check');
            $('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast",
            minDate: 0,
        });

    

       

        $('#mebox').click(()=>{
            $('#message_for').val('me');
            $('#detailsForMe').removeClass('d-none');
            $('#detailsForSomeone').addClass('d-none');

            $('#descBox').html('Craft a personal message to your future self, preserving thoughts and reflections for the journey ahead.');
        });

         $('#someonebox').click(()=>{
            $('#message_for').val('someone');
            $('#detailsForSomeone').removeClass('d-none');
            $('#detailsForMe').removeClass('d-none');
            $('#descBox').html('Compose a heartfelt message for a loved one, creating a timeless gift filled with your sentiments.');
        });

        $('#linkbox').click(()=>{
            $('#message_for').val('link');
            $('#detailsForMe').addClass('d-none');
            $('#detailsForSomeone').addClass('d-none');
            $('#descBox').html('Create a shareable link to your message, allowing you to send your words through time to anyone you choose.');
        });
    });
</script>


<script>
    function stepTwo(){
        $('#step1').addClass('d-none');
        $('#step2').removeClass('d-none');
    }

    function stepOne(){
         $('#step1').removeClass('d-none');
        $('#step2').addClass('d-none');
    }

    function closeModal() {
        $('#formsub').modal('toggle');
    }
</script>
@elseif($page == 'index')

<script>
    $(document).ready(() => {

        var message = `{!! $decryptMessage !!}`;

        $('#messageArea').html(message);

    });
</script>

@endif


</html>
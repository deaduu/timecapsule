<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Timecapsule</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
    </style>
    @if($page == 'timer')
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class=" modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Enter Your Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


                        <div class="grid">
                            <textarea class="ckeditor" name="" id="message" cols="30" rows="10">
                            <p>Hey There,</p>
                            <p>Enter your message for future you or someone special</p>
                        </textarea>
                        </div>

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
                <div class="modal-header">
                    <h5 class="modal-title" id="formsubLabel">Submit Your Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="detailForm" class="row g-3">
                        <div class="col-md-12">
                            <label for="from_email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="from_email" required>
                        </div>
                        <div class="col-md-12">
                            <label for="to_email" class="form-label">Email of the one who will receive the
                                message(optional)</label>
                            <input type="email" class="form-control" id="to_email">
                        </div>

                        <div class="col-md-12">
                            <label for="datepicker" class="form-label">The day the message will show</label>
                            <input type="text" id="datepicker" autocomplete="off" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
    @endif
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@if(!isset($page))
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('message');



    $(document).ready(() => {

        var message = CKEDITOR.instances['message'].getData();

        $('#messageArea').html(message);


        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast",
            minDate: 0,
        });

        $('#saveChanges').click(() => {
            var message = CKEDITOR.instances['message'].getData();
            $('#messageArea').html(message);
        });


        $('#detailForm').submit((e) => {

            e.preventDefault();

            var message = CKEDITOR.instances['message'].getData();
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
            })
        });
    });
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/wv/index.css') }}">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="padding: 0">
                
                <div class="detail-head">
                </div>

                <div class="detail-img" style="width: 80%; margin: 0 auto">
                    <img src="{{ url('news/' . $data->image) }}" style="width: 100%" alt="">
                </div>

                <div style="position:relative; top: -30px">
                    <div class="container">
                        <p style="font-weight: bold; font-size: 1.3em;">{{ $data->title }}</p>
                    </div>
                </div>

                <div style="position:relative; top: -30px">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); background-color: #E9D5F0; border-radius: 10px; text-align: center;">
                                    <p style="padding: 10px; margin: 0; font-weight: bold">{{ date('d-m-Y', strtotime($data->date)) }}</p>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); border-radius: 10px; padding: 10px; background-color: #EEFFFC;">
                                    <span style="font-size: .85em;">{{ date('H:i', strtotime($data->date)) }}</span>
                                </div>
                                <div class="" style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);margin-top: 10px; border-radius: 10px; padding: 10px; background-color: #EEFFFC;">
                                    <span style="font-size: .85em;">{{ $data->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="position:relative; top: 0px">
                    <div class="container" style="font-size: .9em;">
                        <p>{{ $data->content }}</p>
                    </div>
                </div>
                
    
            </div>
        </div>
    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Styles -->
</head>

<body>
    <div class="row text-center">
        <div class="col-sm-6" style="margin: 10%">
            <form method="post" action="/diagnosis">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <select required class="form-control" name="sym">
                        @foreach ($symtoms as $item)
                            <option value="{{ $item['ID'] }}">
                                {{ $item['Name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Year Of Birth</label>
                    <input type="number" name="year" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <select required class="form-control" name="gender">
                        <option value="Male">Male</option>
                        <option value="Male">Male</option>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Get Diagnosis</button>
            </form>
        </div>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

</body>

</html>

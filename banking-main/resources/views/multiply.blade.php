<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="asset/jquery/jquery-3.7.1.js"></script>
    <title>hi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 500px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            text-align: left;
            color: #555;
            margin-left: 5px;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        #output {
            margin-top: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Multiplication Calculator</h1>

        <label for="num1">Number 1:</label>
        <input type="number" class="num1" name="num1" placeholder="Enter the first number">

        <label for="num2">Number 2:</label>
        <input type="number" class="num2" name="num2" placeholder="Enter the second number">

        <button id="calculateBtn">Calculate</button>

        <div id="output"></div>
    </div>

    <script>
        $(document).ready(() => {
            $("#calculateBtn").click(() => {
                $.post('http://localhost:8000/api/multiply',
                    {
                        num1: $(".num1").val(),
                        num2: $(".num2").val()
                    }
                ).done((data) => {
                    var out = $("#output");
                    out.text("");
                    const prod = data.product.toLocaleString(undefined, { style: 'currency', currency: 'PHP' });
                    out.append("<h3>Product: " + prod + "</h3>");
                }).fail((error) => {
                    var out = $("#output");
                    out.text("");
                    out.append("<h3 class='error'>" + error.responseJSON.message + "</h3>");
                });
            });
        });
    </script>

</body>
</html>

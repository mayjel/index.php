<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f0e5e7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('m.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .calculator {
            width: 220px;
            border: 2px solid #ccc;
            padding: 10px;
            margin: 0 auto;
            background-color: transparent;
            height: 280px;
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 10px;
            text-align: right;
            padding: 5px;
            box-sizing: border-box;
            background-color:gray;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 5px;
        }

        .buttons button {
            width: 50px;
            height: 45px;
            font-size: 18px;
            background-color: pink;
            border: thin;
            border-radius: 50%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .display {
            width: 100%;
            height: 60px;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 24px;
            border: none;
            border-radius: 10px;
            background-color: #ffffff;
            text-align: right;
            background-color: transparent;
            margin-top:20px;
        }

        .button {
            width: 100%;
            height: 150px;
            background-color: magenta;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: magenta;
        }

        .operator {
            background-color: orange;
        }

        .operator:hover {
            background-color: red;
        }

        .clear {
            background-color: #ffcccc;
        }

        .clear:hover {
            background-color: #ff6666;
        }
    </style>
</head>
<body>

<div class="calculator">
    <form method="post">
        <input type="text" name="display" id="display" value="<?php echo isset($_POST['display']) ? $_POST['display'] : ''; ?>">
        <div class="buttons">
            <button name="input" value="7" onclick="appendToDisplay('7')">7</button>
            <button name="input" value="8" onclick="appendToDisplay('8')">8</button>
            <button name="input" value="9" onclick="appendToDisplay('9')">9</button>
            <button name="operator" value="/" onclick="appendToDisplay('/')">/</button>
            <button name="input" value="4" onclick="appendToDisplay('4')">4</button>
            <button name="input" value="5" onclick="appendToDisplay('5')">5</button>
            <button name="input" value="6" onclick="appendToDisplay('6')">6</button>
            <button name="operator" value="*" onclick="appendToDisplay('*')">*</button>
            <button name="input" value="1" onclick="appendToDisplay('1')">1</button>
            <button name="input" value="2" onclick="appendToDisplay('2')">2</button>
            <button name="input" value="3" onclick="appendToDisplay('3')">3</button>
            <button name="operator" value="-" onclick="appendToDisplay('-')">-</button>
            <button name="input" value="0" onclick="appendToDisplay('0')">0</button>
            <button name="input" value="." onclick="appendToDisplay('.')">.</button>
            <button name="clear" value="clear" onclick="clearDisplay()">C</button>
            <button name="operator" value="+" onclick="appendToDisplay('+')">+</button>
            <button name="calculate" value="=">=</button>
        </div>
    </form>
    
    <?php
   
    try {
        if (isset($_POST['calculate'])) {
            $expression = $_POST['display'];
            
            if (!preg_match('/^[0-9+\-*/. ]+$/', $expression)) {
                throw new Exception('Invalid input');
            }
            if (strpos($expression, '/0') !== false) {
                throw new Exception('Division by zero is not allowed.');
            }
            $result = eval('return ' . $expression . ';');
            echo '<script>document.getElementById("display").value = "' . $result . '";</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("' . $e->getMessage() . '");</script>';
    }
    ?>

    <script>
        function appendToDisplay(value) {
            document.getElementById('display').value += value;
        }

        function clearDisplay() {
            document.getElementById('display').value = '';
        }
    </script>
</div>

</body>
</html>

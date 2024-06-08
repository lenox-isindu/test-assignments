<?php
function calculate($num1, $num2, $operation) {
    switch ($operation) {
        case 'add': return $num1 + $num2;
        case 'subtract': return $num1 - $num2;
        case 'multiply': return $num1 * $num2;
        case 'divide': return $num2 != 0 ? $num1 / $num2 : 'Error: Division by zero';
        case 'exponentiate': return pow($num1, $num2);
        case 'percentage': return $num1 / 100;
        case 'sqrt': return $num1 >= 0 ? sqrt($num1) : 'Error: Negative number for square root';
        case 'log': return $num1 > 0 ? log($num1) : 'Error: Non-positive number for logarithm';
        default: return 'Invalid operation';
    }
}

$result = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : null;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : null;
    $operation = $_POST['operation'] ?? null;
    $result = calculate($num1, $num2, $operation);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multipurpose Calculator</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function updateInputs() {
            const operation = document.getElementById('operation').value;
            const secondInput = document.getElementById('num2');
            const firstInput = document.getElementById('num1');
            if (['sqrt', 'log', 'percentage'].includes(operation)) {
                secondInput.style.display = 'none';
                secondInput.required = false;
                firstInput.placeholder = 'Enter number';
            } else {
                secondInput.style.display = 'block';
                secondInput.required = true;
                firstInput.placeholder = 'Enter first number';
            }
        }
    </script>
</head>
<body onload="updateInputs()">
    <div class="background">
        <div class="form-container">
            <h1>Multipurpose Calculator</h1>
            <form method="post">
                <input type="number" name="num1" id="num1" placeholder="Enter first number" step="any" required>
                <input type="number" name="num2" id="num2" placeholder="Enter second number" step="any">
                <select name="operation" id="operation" onchange="updateInputs()">
                    <option value="add">Addition</option>
                    <option value="subtract">Subtraction</option>
                    <option value="multiply">Multiplication</option>
                    <option value="divide">Division</option>
                    <option value="exponentiate">Exponentiation</option>
                    <option value="percentage">Percentage</option>
                    <option value="sqrt">Square Root</option>
                    <option value="log">Logarithm</option>
                </select>
                <button type="submit">Calculate</button>
            </form>
            <?php if ($result !== ''): ?>
                <h2>Result: <?= htmlspecialchars($result); ?></h2>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

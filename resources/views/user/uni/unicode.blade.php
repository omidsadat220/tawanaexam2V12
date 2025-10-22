<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voucher Code Verification</title>
    <style>
      :root {
        --primary-bg: #121212;
        --secondary-bg: #1e1e1e;
        --accent-color: #4caf50;
        --text-primary: #f5f5f5;
        --text-secondary: #bdbdbd;
        --error-color: #f44336;
        --success-color: #4caf50;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      body {
        background-color: var(--primary-bg);
        color: var(--text-primary);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      .container {
        background-color: var(--secondary-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 30px;
        width: 100%;
        max-width: 500px;
        transition: all 0.3s ease;
      }

      h1 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        color: var(--accent-color);
      }

      .description {
        text-align: center;
        color: var(--text-secondary);
        margin-bottom: 30px;
        line-height: 1.5;
      }

      .input-group {
        margin-bottom: 25px;
        position: relative;
      }

      .input-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-primary);
      }

      .input-wrapper {
        position: relative;
        display: flex;
      }

      input {
        width: 100%;
        padding: 14px 15px 14px 40px;
        border: 1px solid #333;
        border-radius: var(--border-radius);
        background-color: #2c2c2c;
        color: var(--text-primary);
        font-size: 16px;
        transition: border 0.3s;
      }

      input:focus {
        outline: none;
        border-color: var(--accent-color);
      }

      .icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--accent-color);
        z-index: 2;
      }

      button {
        width: 100%;
        padding: 14px;
        background-color: var(--accent-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
      }

      button:hover {
        background-color: #388e3c;
      }

      .result {
        margin-top: 25px;
        padding: 15px;
        border-radius: var(--border-radius);
        display: none;
      }

      .success {
        background-color: rgba(76, 175, 80, 0.1);
        border-left: 4px solid var(--success-color);
        display: block;
      }

      .error {
        background-color: rgba(244, 67, 54, 0.1);
        border-left: 4px solid var(--error-color);
        display: block;
      }

      .result-content {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .result-icon {
        font-size: 24px;
      }

      .success .result-icon {
        color: var(--success-color);
      }

      .error .result-icon {
        color: var(--error-color);
      }

      .result-text h3 {
        margin-bottom: 5px;
        font-size: 16px;
      }

      .result-text p {
        color: var(--text-secondary);
        font-size: 14px;
      }

      @media (max-width: 480px) {
        .container {
          padding: 20px;
        }

        h1 {
          font-size: 24px;
        }
      }

      /* SVG icon styles */
      .svg-icon {
        width: 20px;
        height: 20px;
        fill: currentColor;
      }
    </style>
  </head>
  <body>
    <?php
      use App\Models\Category;

     
      $category = Category::first();
      $uni_name = $category ? $category->uni_name : 'No University Found';
      ?>
    <div class="container">
      <h1><?php echo $uni_name; ?></h1>
      <p class="description">
        Enter your voucher code below to check its validity and applicable
        benefits
      </p>

      <form action="{{ route('user.varifycode') }}" method="POST">
        @csrf
      <div class="input-group">
        <label for="voucher">University Code || <a href="{{ route('user.dashboard') }}" style="text-decoration: none; color:red"><span >Back</span></a></label>
        <div class="input-wrapper">
          <span class="icon">
            <svg class="svg-icon" viewBox="0 0 24 24">
              <path
                d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z"
              />
            </svg>
          </span>
          <input
            type="text"
            id="voucher"
            name="code"
            placeholder="Enter voucher code"
            autocomplete="off"
          />
        </div>
      </div>

      <button id="verify-btn" type="submit">
        <svg class="svg-icon" viewBox="0 0 24 24" style="color: white">
          <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
        </svg>
        Verify Code
      </button>

    </form>
      <div class="result" id="result">
        <div class="result-content">
          <div class="result-icon">
            <svg class="svg-icon" viewBox="0 0 24 24">
              <path id="status-icon" d="" />
            </svg>
          </div>
          <div class="result-text">
            <h3 id="result-title">Title</h3>
            <p id="result-message">Message will appear here</p>
          </div>
        </div>
      </div>
    </div>

    <script>
      document
        .getElementById("verify-btn")
        .addEventListener("click", function () {
          const voucherCode = document.getElementById("voucher").value.trim();
          const resultDiv = document.getElementById("result");
          const resultTitle = document.getElementById("result-title");
          const resultMessage = document.getElementById("result-message");
          const statusIcon = document.getElementById("status-icon");

          // Reset styling
          resultDiv.className = "result";

          if (!voucherCode) {
            resultDiv.classList.add("error");
            resultTitle.textContent = "Error";
            resultMessage.textContent = "Please enter a voucher code";
            statusIcon.setAttribute(
              "d",
              "M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"
            );
            return;
          }

          // Simulate verification (replace with actual API call in production)
          setTimeout(() => {
            const isValid = /^[A-Z0-9]{10,}$/.test(voucherCode);

            if (isValid) {
              resultDiv.classList.add("success");
              resultTitle.textContent = "Success!";
              resultMessage.textContent = Voucher "${voucherCode}" is valid. You've received a 20% discount!;
              statusIcon.setAttribute(
                "d",
                "M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2ZM10,17L5,12L6.41,10.59L10,14.17L17.59,6.58L19,8L10,17Z"
              );
            } else {
              resultDiv.classList.add("error");
              resultTitle.textContent = "Invalid Voucher";
              resultMessage.textContent = The code "${voucherCode}" is not valid. Please check and try again.;
              statusIcon.setAttribute(
                "d",
                "M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"
              );
            }
          }, 800);
        });
    </script>
  </body>
</html>
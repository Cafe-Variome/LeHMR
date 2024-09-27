<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Link</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: white;
            margin: 0; padding: 0;
        }
        .email-container { 
            max-width: 600px; 
            margin: 20px auto; 
            background-color: #ffffff; 
            padding: 20px; 
            border-radius: 4%;
            box-sizing: border-box;
        }
        .email-header { text-align: center; padding-bottom: 10px; border-bottom: 1px solid #dddddd; }
        .email-header img { width: 150px; }
        .email-body { padding-top: 15px; }
        .email-body h2 { color: #333333; }
        .email-body p { color: #555555; line-height: 1.6; }
        .access-link { 
            background: #8CB61D;
            color: white !important;
            border: 0 none;
            border-radius: 5px;
            cursor: pointer;
            min-width: 130px;
            border: 1px solid #8CB61D;
            margin: 0 5px;
            text-decoration: none;;
            display: inline-block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
        }
        .access-link:hover {   
            background: #405867;
            border-color: #405867;
            color: white;
        }
        .email-footer { padding-top: 20px; font-size: 12px; color: #888888; text-align: center; border-top: 1px solid #dddddd; }
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='email-header'>
            <img src='<?= base_url('public/img/lehmrLogo.png'); ?>' alt='LeHMR'>
        </div>
        <div class='email-body'>
            <p>Dear <?=$userName?>,</p>
            <p>Your access link to view and manage your datasets is ready. Please click the button below to access your datasets:</p>
            <a href='<?= $accessLink; ?>' class='access-link'>Access Your Datasets</a>
            <p>If you did not request this link, please ignore this email.</p>
        </div>
        <div class='email-footer'>
            <p>&copy; <?= date('Y'); ?> LeHMR. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
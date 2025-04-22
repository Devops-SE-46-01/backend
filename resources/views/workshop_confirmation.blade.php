<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Rubik:wght@400;600;700&display=swap" rel="stylesheet" />
    <title>Workshop Confirmation</title>
</head>
<body style="
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    color: #332C2B;
">
<div style="
        background: linear-gradient(110.35deg, #F82F1E -53.36%, #C1271A 83.8%);
        background-image: url('https://i.ibb.co/tztDymY/bg-header.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        padding-top: 4vh;
        padding-bottom: 4vh;
    ">
    <table style="margin: auto;">
        <tr style="vertical-align: middle;">
            <td style="text-align: center;">
                <img src="https://i.ibb.co/DC4jGDs/logo-motion.png" alt="motion-logo" style="width:  4em;">
            </td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 20px;">
                <h1 style="
                        text-align: center;
                        font-family: 'Rubik', sans-serif;
                        font-style: normal;
                        font-weight: 700;
                        font-size: 2em;
                        color: white;
                    ">
                    Mobile Innovation Laboratory
                </h1>
            </td>
        </tr>
    </table>
</div>
<div style="
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        line-height: 28px;
        padding: 30px;
    ">
    <h3 style="
            font-size: 4vh;
        ">Halo, {{ $workshop->name }} 👋</h3>
    <p>
        Terima kasih telah mendaftar pada kegiatan <b>{{ $workshop->workshop->title }}</b> yang diadakan oleh Mobile Innovation Laboratory.
        Berikut kami sertakan link meet untuk kegiatan tersebut.
    </p>
</div>
<div style="text-align: center;">
    <a href="{{ $workshop->workshop->url }}" style="
            border-radius: 40px;
            padding: 15px 50px;
            background-color: #332C2B;
            color: white;
            text-decoration: none;
            font-family: 'Rubik', sans-serif;
            text-align: center;
            font-size: 15px;
        ">Link Meet</a>
</div>
<div style="
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        padding: 30px 30px 0;
        line-height: 28px;
    ">
    <p>
        Jika kamu punya pertanyaan, kamu bisa menghubungi
        <a style="color: #F82F1E;" href="https://liff.line.me/1645278921-kWRPP32q?accountId=biy7493e#mst_challenge=B1ZDBAp9rbyTWPF3iAJ2k1b65qumuPvzH1IvhbvmgZM">Line Motion</a>
        <br>
        Sampai bertemu pada kegiatan workshop 🔥
    </p>
</div>
<div style="
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        padding: 20px 30px;
    ">
</div>
<div style="
        font-family: 'Inter', sans-serif;
        background-image: url('https://i.ibb.co/mcGQndL/footer-bg.png');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-color: #282828;
        color: white;
        padding: 20px 30px;
    ">
    <p>
        Follow Us On
    </p>
    <table>
        <tr>
            <td>
                <img src="https://i.ibb.co/LZ3sG5D/line.png" alt="">
            </td>
            <td>
                <a href="https://liff.line.me/1645278921-kWRPP32q?accountId=biy7493e#mst_challenge=B1ZDBAp9rbyTWPF3iAJ2k1b65qumuPvzH1IvhbvmgZM"
                   style="color: white; text-decoration: none;"
                >Line</a>
            </td>
        </tr>
        <tr>
            <td>
                <img src="https://i.ibb.co/ctRR569/linkedin.png" alt="">
            </td>
            <td>
                <a href="https://www.linkedin.com/company/motion-laboratory/"
                   style="color: white; text-decoration: none;">Linkedin</a>
            </td>
        </tr>
        <tr>
            <td>
                <img src="https://i.ibb.co/SshYzgW/instagram.png" alt="">
            </td>
            <td>
                <a href="https://www.instagram.com/motionlab_/"
                   style="color: white; text-decoration: none;"
                >Instagram</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
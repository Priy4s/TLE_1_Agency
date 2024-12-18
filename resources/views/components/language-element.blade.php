<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expandable Box</title>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'nl,es,it,pl,fr,de,bg,en,hi,ja,ko,ru,zh-CN',
                    autoDisplay: false,
                    gaTrack: true,
                    gaId: '{replace with your gaId}'
                },
                'google_translate_element')
        }
    </script>
    <style>
        tbody tr {
            display: none;
        }

        /* Style the expandable box */
        #expandable-box {
            position: fixed;
            bottom: -1vh;
            width: 15vw; /* Narrow handle width when collapsed */
            background-color: rgba(180, 8, 92, 0.75);
            border-radius: 15px 15px 0 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            margin: 0.5rem;
        }

        #expandable-box:hover{
            left: 0;
        }

        /* Header styling when collapsed */
        .box-header {
            color: #ffffff;
            /*padding: 10px;*/
            cursor: pointer;
            text-align: center;
            height: 100%;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .worldBall {
            background-image: url('{{ asset('images/Animation - 1734442617894.gif') }}');
            width: 5rem;
            height: 5rem;
            background-size: cover;
            background-position: center;
            border-radius: 50%;
        }

        /* Content styling */
        .box-content {
            display: none;
            padding: 15px;
            background-color: #f9f9f9;
            width: auto; /* Adjust width based on content */
            height: auto; /* Adjust height based on content */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* When expanded, show the content */
        .expanded {
            width: 100vw !important; /* Expand the box width */
            margin: 0 !important;
            /*margin-bottom: 1rem !important;*/
            background-color: #AA0160 !important;
            border-radius: 15px 15px 0 0 !important;
        }

        .expanded .box-content {
            display: block;
            /*margin-bottom: -1vh;*/
        }

        .goog-logo-link, .goog-te-gadget span{
            display:none !important;
        }

        .goog-te-gadget{
            color: transparent !important;
        }

        .goog-te-combo{
            width: 90vw;
            /*padding: 0.5rem;*/
            font-family: "Radikal Trial", sans-serif;
            border-radius: 15px;
            color: #122c0d;
            font-weight: bold;
            text-align: center;
            margin-left: 1rem !important;
            border: 1px solid #AA0160;
            background-color: #ffffff;
            font-size: 1.2rem;
        }

        /*#flags {*/
        /*    right: 0;*/
        /*}*/

    </style>
</head>
<body>

<!-- Expandable Box -->
<div id="expandable-box" class="rounded-b-0 rounded-t-[16px]">
    <div class="box-header" onclick="toggleExpand()">
{{--        <span id="flags" style="font-size: xx-large" class="text-white"><img src="{{ asset('images/Animation - 1734442617894.gif') }}" alt="World Ball Gif" class=""></span>--}}
        <div class="worldBall" style="background-image: url('{{ asset('images/Animation - 1734442617894.gif') }}');"></div>

    </div>
    <div class="box-content">
        <div id="google_translate_element"></div>
    </div>
</div>

<script>
    // Function to toggle the expanded state
    function toggleExpand() {
        const box = document.getElementById('expandable-box');
        box.classList.toggle('expanded');
        // Change the "+" to a "-" when expanded and vice versa
        //const header = box.querySelector('.box-header span');
        //header.textContent = box.classList.contains('expanded') ? '🇩🇪' : '🇩🇪';
    }

    // Function to close the box if clicked outside
    function closeIfClickedOutside(event) {
        const box = document.getElementById('expandable-box');
        // Check if the clicked element is outside the expandable box
        if (!box.contains(event.target)) {
            box.classList.remove('expanded');
        }
    }

    // Attach the event listener for clicks on the document
    document.addEventListener('click', closeIfClickedOutside);

    // Prevent closing when clicking inside the expandable box (toggle action)
    document.getElementById('expandable-box').addEventListener('click', function(event) {
        event.stopPropagation();
    });

</script>
<script>
    // List of flag emojis to cycle through
    // const flags = ['⚐ Change language'];

    // Function to cycle through flags
    // function cycleFlags() {
    //     const span = document.getElementById('flags')
    //     let currentFlagIndex = flags.indexOf(span.textContent);
    //     currentFlagIndex = (currentFlagIndex + 1) % flags.length;  // Cycle through flags
    //     span.textContent = flags[currentFlagIndex];
    // }

    // Cycle flags every 2 seconds
    // setInterval(cycleFlags, 2000);
</script>

</body>
</html>

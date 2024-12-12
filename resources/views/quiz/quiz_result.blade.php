<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<x-navbar-layout></x-navbar-layout>

<img class="rounded-full w-[90%] mx-[5%]" src="{{ asset('images/quiz-worker.jpg') }}">

<h1 class="text-4xl font-semibold mb-5 mt-10 text-center font-radical">Your Talents</h1>

<div class="sections">

<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Leader'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Leader'] ?? 0 }}%</span>
        <span class="leading-none">Leader</span>
    </h3>
    <p class="mx-2 text-xl">As a Leader, you naturally take charge, make decisions, and inspire others. You excel
        at overcoming challenges and enjoy guiding teams toward success with a strategic and
        independent approach.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Supporter'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Supporter'] ?? 0 }}%</span>
        <span class="leading-none">Supporter</span>
    </h3>
    <p class="mx-2 text-xl">As a Supporter, you thrive in teamwork, offering emotional support and helping others
        succeed. Your collaborative nature creates strong, positive relationships in any group.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Organizer'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Organizer'] ?? 0 }}%</span>
        <span class="leading-none">Organizer</span>
    </h3>
    <p class="text-xl mt-2">As an Organizer, you’re detail-oriented, efficient, and thrive with structure and clear
        plans. You’re great at keeping things on track and ensuring tasks are completed smoothly.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Creative'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Creative'] ?? 0 }}%</span>
        <span class="leading-none">Creative</span>
    </h3>
    <p class="mx-2 text-xl">As a Creative, you bring fresh ideas and innovative solutions. You enjoy brainstorming and
        thinking outside the box, bringing new possibilities and original solutions to the table.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>

</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const sections = document.querySelectorAll('.role-section');

        const sortedSections = Array.from(sections).sort((a, b) => {
            const percentageA = parseFloat(a.getAttribute('data-percentage'));
            const percentageB = parseFloat(b.getAttribute('data-percentage'));

            return percentageB - percentageA;
        });

        const container = document.querySelector('.sections');

        sortedSections.forEach(section => {
            container.appendChild(section);
        });
    });
</script>

<x-footer-layout></x-footer-layout>

</body>

</html>


@extends('layouts.app')

<x-navbar-layout></x-navbar-layout>

<img class="w-[90%] mx-[5%]" alt="A woman sitting at a desk" src="{{ asset('images/quiz-worker.jpg') }}">

<h1 class="text-4xl font-semibold mb-5 mt-10 text-center font-radical">Your Talents</h1>

<div class="sections">

<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Leader'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Leader'] ?? 0 }}%</span>
        <span class="leading-none">Leader
        <span
            class="speaker-icon"
            aria-label="Click to hear about this skill."
            role="button"
            tabindex="0"
            data-text="Leader. {{ $stylePercentages['Leader'] ?? 0 }} percent. As a Leader, you naturally take charge, make decisions, and inspire others. You excel
        at overcoming challenges and enjoy guiding teams toward success with a strategic and
        independent approach.">
            </span></span>
    </h3>
    <p class="mx-2 text-xl">As a Leader, you naturally take charge, make decisions, and inspire others. You excel at overcoming challenges and enjoy guiding teams toward success with a strategic and independent approach.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Supporter'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Supporter'] ?? 0 }}%</span>
        <span class="leading-none">Supporter
        <span
            class="speaker-icon"
            aria-label="Click to hear about this skill."
            role="button"
            tabindex="0"
            data-text="Supporter. {{ $stylePercentages['Supporter'] ?? 0 }} percent. As a Supporter, you thrive in teamwork, offering emotional support and helping others succeed. Your collaborative nature creates strong, positive relationships in any group."></span>
    </span>
    </h3>
    <p class="mx-2 text-xl">As a Supporter, you thrive in teamwork, offering emotional support and helping others
        succeed. Your collaborative nature creates strong, positive relationships in any group.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Organizer'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Organizer'] ?? 0 }}%</span>
        <span class="leading-none">Organizer
        <span
            class="speaker-icon"
            aria-label="Click to hear about this skill."
            role="button"
            tabindex="0"
            data-text="Organizer. {{ $stylePercentages['Organizer'] ?? 0 }} percent. As an Organizer, you’re detail-oriented, efficient, and thrive with structure and clear plans. You’re great at keeping things on track and ensuring tasks are completed smoothly."></span>
    </span>
    </h3>
    <p class="text-xl mt-2">As an Organizer, you’re detail-oriented, efficient, and thrive with structure and clear
        plans. You’re great at keeping things on track and ensuring tasks are completed smoothly.</p>
    <hr class="border-green border-[0.1rem] my-12 mx-10">
</section>


<section class="role-section ml-8 mr-10" data-percentage="{{ $stylePercentages['Creative'] ?? 0 }}">
    <h3 class="text-[1.8rem] font-bold flex justify-between items-end">
        <span class="text-violet text-[5rem] leading-none italic">{{ $stylePercentages['Creative'] ?? 0 }}%</span>
        <span class="leading-none">Creative
        <span
            class="speaker-icon"
            aria-label="Click to hear about this skill."
            role="button"
            tabindex="0"
            data-text="Creative. {{ $stylePercentages['Creative'] ?? 0 }} percent. As a Creative, you bring fresh ideas and innovative solutions. You enjoy brainstorming and thinking outside the box, bringing new possibilities and original solutions to the table.   "></span>
        </span>
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


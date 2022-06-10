@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">About FastVoting</h2>
    <p class="text-center font-weight-light p-2" style="font-size: 1.35em;">" We can all agree on the importance of voting. "</p>
    <div class="d-flex about">
        <p class="descriptionAbout" style="text-align: justify;">Voting is a general term that refers to a decision-making mechanism or giving a mandate to someone that can be carried out openly or secretly (confidential). If the voting is carried out openly, it is enough for the parties who have an interest to raise their hands and the numbers will be counted.
            However, if it is imposed in secrecy, voters who have the right have to vote or tick their choice in the voting booth , then put it in the ballot box, and finally the number is counted. Voting is one of the chosen mechanisms in running democracy.
            In the current era, if you still apply the conventional method, voters must come directly to the polling station to make their choice and the committee must calculate the vote results manually, of course it is not practical and takes a long time.</p>
        <p class="descriptionAbout" style="text-align: justify;"> Even though there is now a website that can accommodate voting choices, we feel it is still not safe and can lead to fraud. People can vote more than once using different accounts.
            With these problems, we took the initiative to solve existing problems by building a website to conduct voting that is safe and free from fraud.
            Fastvoting is a website-based online voting application that can help you organize events to make decisions easily, quickly and avoid fraud, only people who are invited can vote and each account can only vote once. Voters can choose whoever they want wherever they are without queuing for a time limit determined by the event maker (the committee) with your respective gadgets, be it desktop or mobile.</p>
    </div>
    <img src="{{asset('assets/pexels-element-digital-1550337.jpg')}}" alt="" style="width:100%;">
</div>

@endsection

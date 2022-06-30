@extends('layouts.app')

@section('content')
<div class="container py-4">
    <section style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </section>

    <h2 class="mb-3 text-center">About FastVoting</h2>
    <p class="subtitle text-center">" We can all agree on the importance of voting. "</p>
    <div class="d-flex about">
        <p class="descriptionAbout" style="text-align: justify;">Voting is a general term that refers to a decision-making mechanism or giving a mandate to someone that can be carried out openly or secretly (confidential). If the voting is carried out openly, it is enough for the parties who have an interest to raise their hands and the numbers will be counted.
            However, if it is imposed in secrecy, voters who have the right have to vote or tick their choice in the voting booth , then put it in the ballot box, and finally the number is counted. Voting is one of the chosen mechanisms in running democracy.
            In the current era, if you still apply the conventional method, voters must come directly to the polling station to make their choice and the committee must calculate the vote results manually, of course it is not practical and takes a long time.</p>
        <p class="descriptionAbout" style="text-align: justify;"> Even though there is now a website that can accommodate voting choices, we feel it is still not safe and can lead to fraud. People can vote more than once using different accounts.
            With these problems, we took the initiative to solve existing problems by building a website to conduct voting that is safe and free from fraud.
            Fastvoting is a website-based online voting application that can help you organize events to make decisions easily, quickly and avoid fraud, only people who are invited can vote and each account can only vote once. Voters can choose whoever they want wherever they are without queuing for a time limit determined by the event maker (the committee) with your respective gadgets, be it desktop or mobile.</p>
    </div>
    <div class="py-5 team4">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="text-center">
                <h2 class="mb-3">Our Team</h2>
                <p class="subtitle">These people work on making FastVoting</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/fityan.png')}}" alt="Fityandhiya Islam Nugroho" class="img-fluid rounded-circle mx-auto d-block imgTeam"/>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="pt-2">
                                <h5 class="mt-4 font-weight-medium mb-0">Fityandhiya Islam Nugroho</h5>
                                <h6 class="subtitle mb-2">Backend Developer</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="https://www.linkedin.com/in/fityannugroho" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-linkedin" style="font-size: 1.5em;"></i></a>
                                    <a href="https://www.twitter.com/fityannugroho" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-twitter-square" style="font-size: 1.5em;"></i></a>
                                    <a href="mailto:fityannugroho@gmail.com" class="socialMedia px-1" target="_blank"><i class="fa-solid fa-square-envelope" style="font-size: 1.5em;"></i></a>
                                    <a href="https://github.com/fityannugroho" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-github-square" style="font-size: 1.5em;"></i></a>
                                </div>
                                <p>"Voting is the easiest way to accept the aspirations of many people"</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/Arif.png')}}" alt="Arif Hendrawan Priliyanto" class="img-fluid rounded-circle mx-auto d-block imgTeam"/>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="pt-2">
                                <h5 class="mt-4 font-weight-medium mb-0">Arif Hendrawan Priliyanto</h5>
                                <h6 class="subtitle mb-2">Frontend Developer</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="https:www.linkedin.com/in/arif-hendrawan-priliyanto-3b0b20163" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-linkedin" style="font-size: 1.5em;"></i></a>
                                    <a href="mailto:arifhendrawan023@gmail.com" class="socialMedia px-1" target="_blank"><i class="fa-solid fa-square-envelope" style="font-size: 1.5em;"></i></a>
                                    <a href="https://github.com/arifhendrawan023" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-github-square" style="font-size: 1.5em;"></i></a>
                                </div>
                                <p>"Voting that is safe and free from fraud can increase voter satisfaction and confidence in the results obtained"</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/Aqram.png')}}" alt="Khairul Aqram" class="img-fluid rounded-circle mx-auto d-block imgTeam"/>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="pt-2">
                                <h5 class="mt-4 font-weight-medium mb-0">Khairul Aqram</h5>
                                <h6 class="subtitle mb-2">Backend Developer</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="https://www.linkedin.com/in/khairul-aqram-2b890b228/" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-linkedin" style="font-size: 1.5em;"></i></a>
                                    <a href="https://twitter.com/KhairulAqram21" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-twitter-square" style="font-size: 1.5em;"></i></a>
                                    <a href="https://www.facebook.com/khairul.aqram.9/" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-facebook-square" style="font-size: 1.5em;"></i></a>
                                    <a href="https://www.instagram.com/khairul_aqram21/" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-instagram-square" style="font-size: 1.5em;"></i></a>
                                </div>
                                <p>"The weakest thing about participating in elections is only using the right to vote. Be a sovereign voter, keep an eye on the pilkada, keep your voice"</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('assets/sea.png')}}" alt="Physco Sea Raflisoghi" class="img-fluid rounded-circle mx-auto d-block imgTeam"/>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="pt-2">
                                <h5 class="mt-4 font-weight-medium mb-0">Physco Sea Raflisoghi</h5>
                                <h6 class="subtitle mb-2">Frontend Developer</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="https://www.linkedin.com/in/physco-sea-raflisoghi-a85214218/" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-linkedin" style="font-size: 1.5em;"></i></a>
                                    <a href="https://www.instagram.com/physcose_a/" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-instagram-square" style="font-size: 1.5em;"></i></a>
                                    <a href="mailto:physcosea11@gmail.com" class="socialMedia px-1" target="_blank"><i class="fa-solid fa-square-envelope" style="font-size: 1.5em;"></i></a>
                                    <a href="https://github.com/PhyscoSeaR" class="socialMedia px-1" target="_blank"><i class="fa-brands fa-github-square" style="font-size: 1.5em;"></i></a>
                                </div>
                                <p>"Hopefully this application can help users in making a vote"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

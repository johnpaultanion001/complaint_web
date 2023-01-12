
@component('mail::message')
<style>
    .center {
            margin: auto;
            width: 100%;
            text-align: center;
            text-align: center;
            color: gray;
        }
    hr{
        border-top: .1em solid whitesmoke;
    }
</style>

<div class="center">
    <img src="https://www.cms.gov/sites/default/files/2020-09/HospitalTransparencyIcons_Complaint.png" alt="logo" width="100"/>
    <br>
    <br>
    <strong style="font-size: 22px; text-transform: uppercase;">{{ $content['notif_message'] }}</strong>
    <br>
    <br>
        <strong style="font-size: 18px;">{{ $content['note'] }}</strong>
    <br>
    <br>
   
    
</div>



 

@endcomponent

@vite( ['resources/sass/Admin.scss','resources/js/Admin.js'])
<?php use Illuminate\Support\Carbon;?>
<style>body {
    font-family: 'Helvetica', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #ecf1f4; /* Light Blue */
    color: #333;
}

.container {
    max-width: 800px;
    margin-top:20px;
    margin-left: 30%;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2, h3 {
    color: #3498db; /* Blue */
margin-bottom: 20px;
}
.dee{
    border: 1px solid rgb(161, 161, 161);
    background-color: rgb(241, 241, 241);
    padding:3px ;
    cursor: pointer;
}

</style>

<body>

    <header>
        <h1>Report Page</h1>
      </header>
      
      @extends('all.sideNav')
      
      
      
      <p class="cu" name="Reports"></p>

    <div class="alert alert-success">
        {{session('success')}}
      </div>
    <form action="">
        @csrf
      </form>
    <div class="container">
        

        <div class="report-section">
            @if (count($reports)==0)
                <p>No Reports Available</p>
               @else
               <h3><a href="{{route('clear_report')}}"> Clear Reports</a></h3>
            <ul class="report-list">


                @foreach ($reports as $report)
                <?php $date=Carbon::parse($report->updated_at)?>
                <li class="report-item">
                    <div class="report-details">
                        <strong>This <u> {{$report['type']}}</u> {{ $report['item']}}</strong>
                    </div>
                    <div class="additional-info">
                        <span class="reason"><strong>Reason:</strong>{{ $report['reason']}}</span>
                        <span class="dee" id={{$report['id']}}>Remove</span>
                        <span class="date"><strong>Date:{{$date->toFormattedDateString()}}</strong></span>
                    </div>
                </li>
                @endforeach
            
            </ul>
            @endif
        </div>

       
    </div>

    <script>
        let csrf=document.querySelectorAll("input")[0]
        let dees=document.querySelectorAll(".dee");
        dees.forEach(et => {
            et.addEventListener('click',()=>{
                let id=et.id;
               fetch("/remove_report/"+id,{
                method:"DELETE",
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':csrf.value
                },
            }).then(re=>re.json())
            .then((dat)=>{
                document.querySelector(".alert").innerHTML=dat['message'];
                et.parentElement.parentElement.remove();
                //remove success message after 2s
       if (document.querySelector(".alert")) {
       
       setTimeout(() => {
         document.querySelector(".alert").style.display='none'
       }, 2100);
       }
            })
                
            })
        });
    </script>
</body>
</html>

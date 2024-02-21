<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

</head>
<body>

    <header>
<h2>DashBoard</h2>
    
  </header>

  @extends('all.sideNav')

  @section('con')
 
  @endsection

  <section>
    <p class="cu" name="Dashboard"></p>


    
    <div class="dashboard-summary">
      <div class="summary-box">
        <h3>Downloads</h3>
        <p>300</p>
      </div>

      <div class="summary-box">
        <h3>Posts</h3>
        <p> {{$post}}</p>
      </div>

      <div class="summary-box">
        <h3>Books</h3>
        <p>{{$book}}</p>
      </div>
    </div>

    <div class="graph-container">
      <h2>Daily Sales Graph</h2>
      <!-- Add your graph component here (e.g., using a chart library) -->
    </div>

  

    <div class="invoice-section">
      <h2>Invoices</h2>

      <table>
        <thead>
          <tr>
            <th>Client</th>
            <th>Date</th>
            <th>Invoice</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Client A</td>
            <td>2023-11-01</td>
            <td>#123</td>
            <td>$200</td>
            <td>Paid</td>
            <td class="invoice-item-actions"><button>Delete</button></td>
          </tr>
          <tr>
            <td>Client B</td>
            <td>2023-11-02</td>
            <td>#124</td>
            <td>$150</td>
            <td>Unpaid</td>
            <td class="invoice-item-actions"><button>Delete</button></td>
          </tr>
          <!-- Add more invoice items as needed -->
        </tbody>
      </table>
    </div>
  </section>

</body>
</html>

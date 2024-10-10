<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>test sandile test sandile test</h1>

<form method="POST" action="{{ route('funding.index')  }}" enctype="multipart/form-data" >
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>Funding Amount <input type="number" name="loan" placeholder="Funding Amount" value="{{ old('loan') }}" ></p>
    <p>Email <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" ></p>
    <p>First Name <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" ></p>
    <p>Last Name <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" ></p>
    <p>Contact Number <input type="tel" name="contact_number" placeholder="Contact Number" value="{{ old('contact_number') }}" ></p>
    <p>Company Name <input type="text" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}" ></p>

    <p>type <input type="hidden" name="type" placeholder="Loan Type" value="Business" ></p>
    <p>step <input type="hidden" name="step" placeholder="Step" value="SME South Africa" ></p>

    <p>Business Enterprise Registration Number <input type="text" name="business_reg_number" placeholder="Business Enterprise Registration Number" value="K20174557307" ></p>

    <br><br>

    <p>
        <label for="">What is the funding for?</label>
        <select name="fundingType" >
            <option value="">Select</option>
            <option value="Working Capital (General)">Working Capital (General)</option>
            <option value="Buy Inventory">Buy Inventory</option>
            <option value="Pay a Supplier">Pay a Supplier</option>
            <option value="Buying another Business">Buying another Business</option>
            <option value="Equipment Finance">Equipment Finance</option>
            <option value="Other">Other</option>
        </select>
        
    </p>

    <p>
        <label for="">How long do you need the finance for?</label>
        <select name="loanDuration">
            <option value="">- Select -</option>
            <option value="Very short term (3 months or less )">Very short term (3 months or less )</option>
            <option value="Short term (3 to 12 months)">Short term (3 to 12 months)</option>
        </select>
    </p>
    
    <p>
        <label for="">How long have you been in business?</label>
        <select name="businessYears">
            <option value="">- Select -</option>
            <option value="1 - 2 Years">1 - 2 Years</option>
            <option value="2 - 4 Years">2 - 4 Years</option>
            <option value="4 -5 Years">4 -5 Years</option>
            <option value="5 - 10 Years">5 - 10 Years</option>
            <option value="10 + Years">10 + Years</option>
        </select>
    </p>
    
    <p>
        <label for="">Monthly turnover</label>
        <select name="monthlyTurnOver" id="ff_74_monthlyTurnOver">
            <option value="">- Select -</option>
            <option value="R40K - R100K">R40K - R100K</option>
            <option value="R100K - R200K">R100K - R200K</option>
            <option value="R300K - R500K">R300K - R500K</option>
            <option value="R500K+">R500K+</option>
        </select>
    </p>

    <br><br>


    <p>
        <label for="">Bank</label>
        <select name="bank">
            <option value="">- Select -</option>
            <option value="FNB">FNB</option>
            <option value="ABSA">ABSA</option>
            <option value="Capitec Bank">Capitec Bank</option>
            <option value="item_4">Item 4</option>
            <option value="Nedbank">Nedbank</option>
            <option value="Standard Bank">Standard Bank</option>
            <option value="Investec Bank">Investec Bank</option>
            <option value="Bidvest Bank">Bidvest Bank</option>
            <option value="Discovery Bank">Discovery Bank</option>
            <option value="TymeBank">TymeBank</option>
            <option value="Africa Bank">Africa Bank</option>
            <option value="Gro Bank">Gro Bank</option>
        </select>
    </p>

    <p>
        <label for="">Account Type</label>
        <select name="accountType">
            <option value="">- Select -</option>
            <option value="Cheque Account">Cheque Account</option>
            <option value="Savings Account">Savings Account</option>
        </select>
    </p>

        <p>type <input type="hidden" name="accountOwner" placeholder="Account Owner" value="Business" ></p>
    
    <p>
        <label for="">Upload bank statement</label>
        <input type="file" name="bankStatement" id="bankStatement" value="">
    </p>
    
    <p>
        <label for="">Bank Account Number / Client reference</label>
        <input type="text" name="customerReference" placeholder="Bank Account Number / Client reference" value="{{ old('customerReference') }}" >
    </p>

    <br><br>

    <p>
        <label for="">ID Number</label>
        <input type="number" name="IDnumber" placeholder="ID number ( only SA national id accepted )" value="{{ old('IDnumber') }}" >
    </p>

    <p>
        <label for="">City</label>
        <input type="text" name="city" placeholder="City" value="{{ old('city') }}" >
    </p>

    <p>
        <label for="">Postal Code</label>
        <input type="number" name="postalCode" placeholder="Postal Code" value="{{ old('postalCode') }}" >
    </p>

    <p>
        <label for="">Upload Identity</label>
        <input type="file" name="identity" id="identity" value="" >
    </p>

    <input type="submit" value="Submit">
</form>

</body>
</html>
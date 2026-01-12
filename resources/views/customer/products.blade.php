<!DOCTYPE html>
<html>
<head>
    <title>Coffee Shop Culture</title>

    <style>
        body {
            margin:0;
            background:#000;
            color:white;
            font-family:Arial;
        }

        header {
            position:fixed;
            top:0;
            width:100%;
            background:#c79e2d;
            padding:15px;
            text-align:center;
            font-size:22px;
            z-index:1000;
        }

.section {
    margin:100px auto 30px;
    max-width:1200px;
    padding:0 20px;
}


        .section h2 {
            text-align:center;
            margin-bottom:15px;
        }

.catalog {
    display:flex;
    gap:20px;
    overflow-x:auto;
    justify-content:flex-start;
    padding:10px 10px 20px;
}
.catalog::-webkit-scrollbar {
    height:8px;
}

.catalog::-webkit-scrollbar-thumb {
    background:#c79e2d;
    border-radius:10px;
}

.catalog::-webkit-scrollbar-track {
    background:#222;
}


        .menu-item {
            width:200px;
            background:#111;
            padding:10px;
            border-radius:10px;
            text-align:center;
            flex-shrink:0;
        }

        .menu-item img {
            width:100%;
            height:150px;
            object-fit:cover;
            border-radius:10px;
        }

        .btn {
            background:#c79e2d;
            border:none;
            padding:8px 15px;
            color:white;
            border-radius:5px;
            cursor:pointer;
        }

        .modal-bg {
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,.7);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:2000;
        }

        .modal-box {
            background:#111;
            width:300px;
            padding:20px;
            border-radius:8px;
            text-align:center;
        }
    </style>
</head>
<body>

<header>Coffee Shop Culture</header>

<div class="section">
<h2>Coffee</h2>
<div class="catalog">
@foreach($products->where('category','coffee') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}')">Add</button>
</div>
@endforeach
</div>
</div>

<div class="section">
<h2>Non Coffee</h2>
<div class="catalog">
@foreach($products->where('category','non_coffee') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}')">Add</button>
</div>
@endforeach
</div>
</div>

<div class="section">
<h2>Foods</h2>
<div class="catalog">
@foreach($products->where('category','foods') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}')">Add</button>
</div>
@endforeach
</div>
</div>

<div id="customModal" class="modal-bg" style="display:none">
<div class="modal-box">
<h3 id="modalName"></h3>

<form id="addForm" method="POST" action="{{ url('/cart/add') }}">
@csrf
<input type="hidden" name="product_id" id="modalProductId">

<label><input type="checkbox" name="hot"> Hot</label><br>
<label><input type="checkbox" name="less_ice"> Less Ice</label><br>
<label><input type="checkbox" name="double_shot"> Double Shot</label><br>
<label><input type="checkbox" name="ice"> Ice</label><br><br>

<button type="submit" class="btn">Tambah</button>
<button type="button" class="btn" onclick="closeModal()">Batal</button>
</form>
</div>
</div>

<div id="successModal" class="modal-bg" style="display:none">
<div class="modal-box">
<p>Pesanan berhasil.<br>Orderan kamu akan segera diproses.</p><br>
<button class="btn" onclick="closeSuccess()">Oke</button>
</div>
</div>

<script>
document.getElementById('addForm').addEventListener('submit', function(e){
    e.preventDefault()

    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: new FormData(this)
    })
    .then(res => res.json())
    .then(() => {
        closeModal()
        document.getElementById('successModal').style.display = 'flex'
    })
})

function openModal(id, name){
    document.getElementById('modalProductId').value = id
    document.getElementById('modalName').innerText = name
    document.getElementById('customModal').style.display = 'flex'
}

function closeModal(){
    document.getElementById('customModal').style.display = 'none'
}

function closeSuccess(){
    document.getElementById('successModal').style.display = 'none'
}
</script>

</body>
</html>

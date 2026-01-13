<!DOCTYPE html>
<html>
<head>
    <title>Coffee Shop Culture</title>

    <style>
        body { margin:0; background:#000; color:white; font-family:Arial }
        header { position:fixed; top:0; width:100%; background:#c79e2d; padding:15px; text-align:center; font-size:22px; z-index:1000 }
        .section { margin:100px auto 30px; max-width:1100px }
        .catalog { display:flex; gap:20px; overflow-x:auto; padding:0 20px }

        /* Scrollbar horizontal khusus katalog */
        .catalog::-webkit-scrollbar {
            height: 8px;
        }
        .catalog::-webkit-scrollbar-track {
            background: #222;
        }
        .catalog::-webkit-scrollbar-thumb {
            background-color: #c79e2d;
            border-radius: 4px;
        }
        .catalog::-webkit-scrollbar-thumb:hover {
            background-color: #b5891f;
        }

        .menu-item { width:200px; background:#111; padding:10px; border-radius:10px; text-align:center; flex-shrink:0 }
        .menu-item img { width:100%; height:150px; object-fit:cover; border-radius:10px }
        .btn { background:#c79e2d; border:none; padding:8px 15px; color:black; border-radius:5px; cursor:pointer; margin-top:6px }

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
            width:320px;
            padding:20px;
            border-radius:8px;
            text-align:center;
        }

        .qty-box {
            display:flex;
            justify-content:center;
            align-items:center;
            gap:10px;
            margin:10px 0;
        }

        .qty-box button {
            width:30px;
            height:30px;
            background:#c79e2d;
            border:none;
            color:black;
            font-size:18px;
            cursor:pointer;
            border-radius:5px;
        }
    </style>
</head>
<body>

<header>Coffee Shop Culture</header>

<div class="section">
<h2 style="text-align:center">Coffee</h2>
<div class="catalog">
@foreach($products->where('category','coffee') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}', 'coffee')">Add</button>
</div>
@endforeach
</div>
</div>

<div class="section">
<h2 style="text-align:center">Non Coffee</h2>
<div class="catalog">
@foreach($products->where('category','non_coffee') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}', 'non_coffee')">Add</button>
</div>
@endforeach
</div>
</div>

<div class="section">
<h2 style="text-align:center">Foods</h2>
<div class="catalog">
@foreach($products->where('category','foods') as $product)
<div class="menu-item">
<img src="{{ asset('storage/'.$product->image) }}">
<p>{{ $product->name }}</p>
<p>Rp {{ number_format($product->price,0,',','.') }}</p>
<button class="btn" onclick="openModal({{ $product->id }}, '{{ $product->name }}', 'foods')">Add</button>
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
<input type="hidden" name="category" id="modalCategory">

<div id="optionBox"></div>

<div class="qty-box">
<button type="button" onclick="changeQty(-1)">-</button>
<span id="qtyText">1</span>
<button type="button" onclick="changeQty(1)">+</button>
</div>
<input type="hidden" name="qty" id="qtyInput" value="1">

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
let qty = 1

function openModal(id, name, category){
    document.getElementById('modalProductId').value = id
    document.getElementById('modalName').innerText = name
    document.getElementById('modalCategory').value = category

    qty = 1
    document.getElementById('qtyText').innerText = qty
    document.getElementById('qtyInput').value = qty

    let optionBox = document.getElementById('optionBox')
    optionBox.innerHTML = ''

    if(category === 'coffee'){
        optionBox.innerHTML = `
            <label><input type="checkbox" name="hot"> Hot</label><br>
            <label><input type="checkbox" name="less_ice"> Less Ice</label><br>
            <label><input type="checkbox" name="double_shot"> Double Shot</label><br>
            <label><input type="checkbox" name="ice"> Ice</label><br><br>
        `
    }

    if(category === 'non_coffee'){
        optionBox.innerHTML = `
            <label><input type="checkbox" name="less_ice"> Less Ice</label><br>
            <label><input type="checkbox" name="Normal"> Normal</label><br><br>
        `
    }

    document.getElementById('customModal').style.display = 'flex'
}

function changeQty(val){
    qty += val
    if(qty < 1) qty = 1
    document.getElementById('qtyText').innerText = qty
    document.getElementById('qtyInput').value = qty
}

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

function closeModal(){
    document.getElementById('customModal').style.display = 'none'
}

function closeSuccess(){
    document.getElementById('successModal').style.display = 'none'
}
</script>

</body>
</html>

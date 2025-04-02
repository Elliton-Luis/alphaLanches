<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
    @foreach ($buttons as $btn)
        <div class="col">
            <button class="btn btn-light square-btn" data-route="{{ url($btn['route']) }}" onclick="redirectTo(this)">
                <i class="bi bi-{{ $btn['icon'] }} icon-size"></i>
                <div class="label-size">{{ $btn['label'] }}</div>
            </button>                    
        </div>
    @endforeach
</div>

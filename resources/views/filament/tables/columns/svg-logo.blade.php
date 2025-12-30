<div>
    @if($getState())
        <img src="{{ Storage::url($getState()) }}" alt="Logo" style="width: 40px; height: 40px; object-fit: contain;">
    @else
        <span class="text-gray-400">-</span>
    @endif
</div>
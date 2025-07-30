@props([
    'show' => false,
    'title' => 'Confirmer la suppression',
    'message' => 'Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.',
    'itemName' => '',
    'deleteUrl' => '',
    'cancelText' => 'Annuler',
    'deleteText' => 'Supprimer'
])

<div x-show="{{ $show }}" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     x-on:keydown.escape.window="$dispatch('close-delete-modal')"
     style="display: {{ $show ? 'block' : 'none' }};">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="$dispatch('close-delete-modal')"></div>
    
    <!-- Modal -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="{{ $show }}"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6"
             @click.stop
             style="display: {{ $show ? 'block' : 'none' }};">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-center mb-4">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
            </div>
            
            <!-- Modal Content -->
            <div class="text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    {{ $title }}
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    {{ $message }}
                    @if($itemName)
                        <span class="font-semibold text-gray-900">{{ $itemName }}</span> ?
                    @endif
                </p>
            </div>
            
            <!-- Modal Actions -->
            <div class="flex justify-center space-x-3">
                <button 
                    @click="$dispatch('close-delete-modal')"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    {{ $cancelText }}
                </button>
                <form action="{{ $deleteUrl }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        {{ $deleteText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> 
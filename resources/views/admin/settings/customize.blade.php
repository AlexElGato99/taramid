<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10 gap-y-2">
    <div class="lg:col-span-12">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{__('Hero Section')}}</h3>
            
            <div class="p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" x-data="colorPicker()">
                <x-form.label for="hero_icons_color" :value="__('Feature Icons Color')"/>
                
                <div class="mt-4 space-y-4">
                    <!-- Hidden input for form submission -->
                    <input type="hidden" 
                           id="hero_icons_color" 
                           name="hero_icons_color" 
                           x-model="selectedColor">
                    
                    <!-- Color Picker Interface -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Quick Colors -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 block">{{__('Quick Select')}}</label>
                            <div class="grid grid-cols-6 gap-2">
                                <template x-for="color in quickColors" :key="color">
                                    <button type="button"
                                            @click="selectColor(color)"
                                            class="w-12 h-12 rounded-lg border-2 cursor-pointer transition-all hover:scale-110"
                                            :class="selectedColor === color ? 'border-blue-500 ring-2 ring-blue-300' : 'border-gray-300 dark:border-gray-600'"
                                            :style="'background-color: ' + color"
                                            :title="color"></button>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Custom Color Input -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 block">{{__('Custom Color')}}</label>
                            <div class="space-y-3">
                                <!-- Browser Color Picker -->
                                <div class="flex gap-3">
                                    <div class="relative">
                                        <input type="color" 
                                               x-model="selectedColor"
                                               @input="updatePreview()"
                                               class="w-20 h-20 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-1">{{__('Click here')}}</p>
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" 
                                               x-model="selectedColor"
                                               @input="updatePreview()"
                                               class="w-full px-4 py-3 text-lg border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 font-mono uppercase"
                                               placeholder="#FFFFFF"
                                               maxlength="7">
                                        <button type="button" 
                                                @click="resetColor()"
                                                class="mt-2 w-full px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                            {{__('Reset')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preview -->
                    <div class="mt-6 p-6 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-24 rounded-2xl shadow-2xl border-4 border-white dark:border-gray-700 transition-all duration-300"
                                 :style="'background-color: ' + selectedColor"></div>
                            <div>
                                <p class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{__('Selected Color Preview')}}</p>
                                <p class="text-base font-mono text-gray-600 dark:text-gray-300 mb-2" x-text="selectedColor"></p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{__('This color will be applied to hero slider icons')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <x-form.error class="mt-3" :messages="$errors->get('hero_icons_color')"/>
            </div>
        </div>
    </div>
</div>

<script>
function colorPicker() {
    return {
        selectedColor: '{{ old('hero_icons_color', config('settings.hero_icons_color', '#FFFFFF')) }}',
        quickColors: [
            '#FFFFFF', '#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00',
            '#FF00FF', '#00FFFF', '#FFA500', '#800080', '#FFC0CB', '#A52A2A',
            '#808080', '#FFD700', '#4B0082', '#F0E68C', '#E6E6FA', '#FF6347'
        ],
        selectColor(color) {
            this.selectedColor = color.toUpperCase();
        },
        updatePreview() {
            if (/^#[0-9A-F]{6}$/i.test(this.selectedColor)) {
                this.selectedColor = this.selectedColor.toUpperCase();
            }
        },
        resetColor() {
            this.selectedColor = '#FFFFFF';
        }
    }
}
</script>

<div class="min-h-screen flex flex-col w-full mt-10 p-5">
    <div class="flex-grow w-full h-full  items-start    rounded-md">
        <div class="w-full ">
            {{ $slot }}
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('dropdown', () => ({
                        open: false,
             
                        toggle() {
                            this.open = ! this.open
                        }
                    }))
                })
            
              
                


        </script>
        </div>
    </div>
</div>
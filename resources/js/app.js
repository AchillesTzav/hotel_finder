import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";


function initFlatpickr() {
    flatpickr('#flatpickr-date', {
        mode: "range",
        minDate: "today",
        dateFormat: "Y-m-d", // value stored in wire:model
        altInput: true,
        altFormat: "Y-m-d",
        //rangeSeparator: " - ",
        onChange: function(selectedDates, dateStr, instance) {
            console.log(selectedDates);
            console.log(dateStr);
            console.log(instance);

            if (selectedDates.length === 2) {
                const [checkin, checkout] = selectedDates.map(date => 
                    date.toISOString().slice(0, 10) // format as "YYYY-MM-DD"
                );

                const payload = {
                    checkin, 
                    checkout
                };
                
                Livewire.dispatch('addDatesToSearch', [payload]);
            }
            
        }
    })

}

// run when the page first loads 

document.addEventListener('livewire:init', () => {
    initFlatpickr();
})

document.addEventListener('livewire:initialized', () => {
    initFlatpickr();
})


document.addEventListener('livewire:load', () => {
    initFlatpickr();
});

// Re-initialize flatpickr after every Livewire update (DOM refresh)
document.addEventListener('livewire:update', () => {
    initFlatpickr();
});



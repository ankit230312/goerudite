<script>
    window.indiaStateCityMap = {
        "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Tirupati", "Kurnool"],
        "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat", "Tawang", "Ziro"],
        "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Nagaon"],
        "Bihar": ["Patna", "Gaya", "Muzaffarpur", "Bhagalpur", "Darbhanga"],
        "Chhattisgarh": ["Raipur", "Bhilai", "Bilaspur", "Korba", "Durg"],
        "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda"],
        "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar"],
        "Haryana": ["Gurugram", "Faridabad", "Panipat", "Ambala", "Hisar"],
        "Himachal Pradesh": ["Shimla", "Dharamshala", "Mandi", "Solan", "Kullu"],
        "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Hazaribagh"],
        "Karnataka": ["Bengaluru", "Mysuru", "Mangaluru", "Hubballi", "Belagavi"],
        "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kollam"],
        "Madhya Pradesh": ["Indore", "Bhopal", "Jabalpur", "Gwalior", "Ujjain"],
        "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Thane"],
        "Manipur": ["Imphal", "Thoubal", "Bishnupur", "Churachandpur", "Ukhrul"],
        "Meghalaya": ["Shillong", "Tura", "Jowai", "Nongpoh", "Baghmara"],
        "Mizoram": ["Aizawl", "Lunglei", "Champhai", "Saiha", "Kolasib"],
        "Nagaland": ["Kohima", "Dimapur", "Mokokchung", "Tuensang", "Wokha"],
        "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Sambalpur", "Puri"],
        "Punjab": ["Ludhiana", "Amritsar", "Jalandhar", "Patiala", "Bathinda"],
        "Rajasthan": ["Jaipur", "Jodhpur", "Udaipur", "Kota", "Bikaner"],
        "Sikkim": ["Gangtok", "Namchi", "Gyalshing", "Mangan", "Rangpo"],
        "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem"],
        "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Karimnagar", "Khammam"],
        "Tripura": ["Agartala", "Dharmanagar", "Udaipur", "Kailashahar", "Belonia"],
        "Uttar Pradesh": ["Lucknow", "Kanpur", "Noida", "Varanasi", "Agra"],
        "Uttarakhand": ["Dehradun", "Haridwar", "Roorkee", "Haldwani", "Nainital"],
        "West Bengal": ["Kolkata", "Howrah", "Durgapur", "Siliguri", "Asansol"],
        "Andaman and Nicobar Islands": ["Port Blair", "Havelock", "Diglipur", "Mayabunder", "Rangat"],
        "Chandigarh": ["Chandigarh"],
        "Dadra and Nagar Haveli and Daman and Diu": ["Daman", "Diu", "Silvassa"],
        "Delhi": ["New Delhi", "North Delhi", "South Delhi", "Dwarka", "Rohini"],
        "Jammu and Kashmir": ["Srinagar", "Jammu", "Anantnag", "Baramulla", "Kupwara"],
        "Ladakh": ["Leh", "Kargil", "Diskit", "Nyoma", "Dras"],
        "Lakshadweep": ["Kavaratti", "Agatti", "Minicoy", "Amini", "Andrott"],
        "Puducherry": ["Puducherry", "Karaikal", "Mahe", "Yanam", "Ozhukarai"]
    };

    function initializeIndiaStateCityDropdowns(scope) {
        const container = scope || document;
        const stateSelects = container.querySelectorAll('select[data-state-select]');

        stateSelects.forEach(stateSelect => {
            const group = stateSelect.dataset.locationGroup || 'default';
            const form = stateSelect.closest('form') || document;
            const citySelect = form.querySelector('select[data-city-select][data-location-group="' + group + '"]');

            if (!citySelect) {
                return;
            }

            const selectedState = stateSelect.dataset.selectedState || stateSelect.value || '';
            const selectedCity = citySelect.dataset.selectedCity || citySelect.value || '';

            if (stateSelect.options.length <= 1) {
                Object.keys(window.indiaStateCityMap).sort().forEach(state => {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    if (state === selectedState) {
                        option.selected = true;
                    }
                    stateSelect.appendChild(option);
                });
            } else if (selectedState) {
                stateSelect.value = selectedState;
            }

            const populateCities = (stateValue, preserveCity = '') => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                citySelect.disabled = !stateValue;

                if (!stateValue || !window.indiaStateCityMap[stateValue]) {
                    return;
                }

                window.indiaStateCityMap[stateValue].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    if (city === preserveCity) {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
            };

            populateCities(selectedState, selectedCity);

            stateSelect.addEventListener('change', function () {
                populateCities(this.value);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initializeIndiaStateCityDropdowns();
    });
</script>

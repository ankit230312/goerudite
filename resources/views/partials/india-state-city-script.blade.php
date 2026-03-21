<script>
    window.indiaStateCityMap = {
        "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool", "Rajahmundry", "Tirupati", "Kakinada", "Kadapa", "Anantapur", "Eluru", "Vizianagaram", "Ongole", "Nandyal", "Machilipatnam", "Tenali", "Chittoor", "Hindupur", "Srikakulam", "Madanapalle", "Adoni", "Dharmavaram", "Gudivada"],
        "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Pasighat", "Namsai", "Tawang", "Ziro", "Tezu", "Roing", "Bomdila", "Aalo", "Changlang", "Khonsa", "Seppa", "Yingkiong", "Daporijo"],
        "Assam": ["Guwahati", "Silchar", "Dibrugarh", "Jorhat", "Nagaon", "Tinsukia", "Tezpur", "Bongaigaon", "Sivasagar", "Karimganj", "Diphu", "Dhubri", "Goalpara", "Barpeta", "Lakhimpur", "Golaghat", "Hailakandi", "Kokrajhar", "Hojai"],
        "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Purnia", "Darbhanga", "Arrah", "Begusarai", "Katihar", "Munger", "Chhapra", "Danapur", "Saharsa", "Hajipur", "Sasaram", "Dehri", "Siwan", "Motihari", "Nawada", "Bagaha", "Buxar", "Kishanganj", "Sitamarhi"],
        "Chhattisgarh": ["Raipur", "Bhilai", "Bilaspur", "Korba", "Durg", "Rajnandgaon", "Raigarh", "Jagdalpur", "Ambikapur", "Dhamtari", "Mahasamund", "Bhatapara", "Chirmiri", "Kanker", "Kawardha", "Dongargarh", "Janjgir", "Naila Janjgir"],
        "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda", "Bicholim", "Curchorem", "Sanquelim", "Cuncolim", "Valpoi", "Sanguem", "Canacona", "Pernem"],
        "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar", "Jamnagar", "Gandhinagar", "Junagadh", "Navsari", "Anand", "Nadiad", "Morbi", "Surendranagar", "Bharuch", "Vapi", "Bhuj", "Porbandar", "Palanpur", "Valsad", "Godhra", "Patan", "Dahod", "Botad", "Amreli"],
        "Haryana": ["Gurugram", "Faridabad", "Panipat", "Ambala", "Hisar", "Karnal", "Rohtak", "Sonipat", "Panchkula", "Yamunanagar", "Bhiwani", "Sirsa", "Bahadurgarh", "Jind", "Thanesar", "Kaithal", "Rewari", "Palwal", "Fatehabad", "Narnaul"],
        "Himachal Pradesh": ["Shimla", "Dharamshala", "Mandi", "Solan", "Baddi", "Nahan", "Kullu", "Palampur", "Hamirpur", "Una", "Bilaspur", "Chamba", "Dalhousie", "Manali", "Kangra", "Sundarnagar", "Rampur"],
        "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Deoghar", "Phusro", "Hazaribagh", "Giridih", "Ramgarh", "Medininagar", "Chirkunda", "Jhumri Telaiya", "Sahibganj", "Chaibasa", "Lohardaga", "Chatra", "Ghatshila", "Pakur", "Godda"],
        "Karnataka": ["Bengaluru", "Mysuru", "Hubballi-Dharwad", "Mangaluru", "Belagavi", "Kalaburagi", "Davanagere", "Ballari", "Vijayapura", "Shivamogga", "Tumakuru", "Raichur", "Bidar", "Udupi", "Hospet", "Gadag", "Hassan", "Bhadravati", "Chitradurga", "Kolar", "Mandya", "Chikkamagaluru", "Bagalkot"],
        "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Kollam", "Thrissur", "Alappuzha", "Kannur", "Palakkad", "Kottayam", "Manjeri", "Thalassery", "Ponnani", "Vatakara", "Kanhangad", "Payyanur", "Koyilandy", "Neyyattinkara", "Taliparamba", "Malappuram", "Pathanamthitta"],
        "Madhya Pradesh": ["Indore", "Bhopal", "Jabalpur", "Gwalior", "Ujjain", "Sagar", "Dewas", "Satna", "Ratlam", "Rewa", "Katni", "Singrauli", "Burhanpur", "Khandwa", "Morena", "Bhind", "Chhindwara", "Guna", "Shivpuri", "Vidisha", "Chhatarpur", "Damoh", "Mandsaur", "Khargone", "Neemuch"],
        "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Thane", "Chhatrapati Sambhajinagar (Aurangabad)", "Solapur", "Kalyan-Dombivli", "Vasai-Virar", "Navi Mumbai", "Bhiwandi", "Amravati", "Nanded", "Kolhapur", "Akola", "Jalgaon", "Latur", "Dhule", "Ahmednagar", "Chandrapur", "Parbhani", "Jalna", "Bhusawal", "Navi Mumbai", "Panvel", "Satara", "Beed", "Yavatmal", "Gondia", "Barshi"],
        "Manipur": ["Imphal", "Thoubal", "Kakching", "Bishnupur", "Churachandpur", "Ukhrul", "Senapati", "Tamenglong", "Chandel", "Jiribam", "Moreh"],
        "Meghalaya": ["Shillong", "Tura", "Nongstoin", "Jowai", "Nongpoh", "Baghmara", "Williamnagar", "Mairang", "Resubelpara", "Khliehriat"],
        "Mizoram": ["Aizawl", "Lunglei", "Champhai", "Siaha", "Kolasib", "Serchhip", "Lawngtlai", "Mamit", "Khawzawl", "Hnahthial", "Saitual"],
        "Nagaland": ["Dimapur", "Kohima", "Mokokchung", "Tuensang", "Wokha", "Zunheboto", "Kiphire", "Phek", "Mon", "Peren", "Longleng", "Noklak"],
        "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Brahmapur", "Sambalpur", "Puri", "Balasore", "Bhadrak", "Baripada", "Jharsuguda", "Bargarh", "Rayagada", "Bhawanipatna", "Bolangir", "Kendujhar", "Jeypore", "Angul", "Dhenkanal", "Barbil", "Paradeep", "Sunabeda"],
        "Punjab": ["Ludhiana", "Amritsar", "Jalandhar", "Patiala", "Bathinda", "Mohali", "Hoshiarpur", "Batala", "Pathankot", "Moga", "Abohar", "Malerkotla", "Khanna", "Phagwara", "Muktsar", "Barnala", "Rajpura", "Firozpur", "Kapurthala", "Faridkot"],
        "Rajasthan": ["Jaipur", "Jodhpur", "Kota", "Bikaner", "Ajmer", "Udaipur", "Bhilwara", "Alwar", "Bharatpur", "Sikar", "Pali", "Sri Ganganagar", "Kishangarh", "Baran", "Dholpur", "Tonk", "Beawar", "Hanumangarh", "Sawai Madhopur", "Churu", "Gangapur", "Jhunjhunu", "Barmer", "Jaisalmer"],
        "Sikkim": ["Gangtok", "Namchi", "Gyalshing", "Mangan", "Rangpo", "Singtam", "Nayabazar", "Jorethang", "Rhenock", "Pakyong"],
        "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Tirunelveli", "Tiruppur", "Erode", "Vellore", "Thoothukudi", "Dindigul", "Thanjavur", "Hosur", "Sivakasi", "Karur", "Nagercoil", "Kanchipuram", "Kumarapalayam", "Karaikudi", "Neyveli", "Cuddalore", "Kumbakonam", "Tiruvannamalai", "Pollachi"],
        "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Khammam", "Karimnagar", "Ramagundam", "Mahbubnagar", "Nalgonda", "Adilabad", "Suryapet", "Miryalaguda", "Jagtial", "Mancherial", "Kamareddy", "Kothagudem", "Bodhan", "Palwancha", "Siddipet", "Zahirabad"],
        "Tripura": ["Agartala", "Dharmanagar", "Udaipur", "Kailashahar", "Belonia", "Ambassa", "Khowai", "Bishalgarh", "Melaghar", "Teliamura", "Sonamura", "Santirbazar"],
        "Uttar Pradesh": ["Lucknow", "Kanpur", "Ghaziabad", "Agra", "Varanasi", "Meerut", "Prayagraj (Allahabad)", "Bareilly", "Aligarh", "Moradabad", "Saharanpur", "Gorakhpur", "Noida", "Firozabad", "Jhansi", "Muzaffarnagar", "Mathura", "Ayodhya", "Rampur", "Shahjahanpur", "Farrukhabad", "Budaun", "Maunath Bhanjan", "Hapur", "Etawah", "Mirzapur", "Bulandshahr", "Sambhal", "Amroha", "Hardoi", "Fatehpur", "Raebareli", "Orai", "Gonda", "Mainpuri", "Azamgarh", "Basti", "Sitapur", "Bahraich", "Unnao", "Jaunpur"],
        "Uttarakhand": ["Dehradun", "Haridwar", "Roorkee", "Haldwani", "Rudrapur", "Kashipur", "Rishikesh", "Nainital", "Ramnagar", "Pithoragarh", "Manglaur", "Jaspur", "Kichha", "Tehri", "Almora", "Mussoorie", "Srinagar", "Pauri", "Kotdwar"],
        "West Bengal": ["Kolkata", "Asansol", "Siliguri", "Durgapur", "Bardhaman", "Malda", "Baharampur", "Habra", "Kharagpur", "Shantipur", "Dankuni", "Dhulian", "Ranaghat", "Haldia", "Raiganj", "Krishnanagar", "Nabadwip", "Medinipur", "Jalpaiguri", "Balurghat", "Basirhat", "Bankura", "Chakdaha", "Darjeeling", "Alipurduar", "Purulia", "Cooch Behar"],
        "Andaman and Nicobar Islands": ["Port Blair", "Swaraj Dweep (Havelock)", "Diglipur", "Mayabunder", "Rangat", "Car Nicobar", "Ferrargunj", "Garacharma", "Bambooflat"],
        "Chandigarh": ["Chandigarh", "Mani Majra", "Burail", "Attawa"],
        "Dadra and Nagar Haveli and Daman and Diu": ["Daman", "Diu", "Silvassa", "Amli", "Dadra"],
        "Delhi": ["New Delhi", "North Delhi", "South Delhi", "East Delhi", "West Delhi", "Dwarka", "Rohini", "Saket", "Vasant Kunj", "Karol Bagh", "Connaught Place", "Janakpuri", "Laxmi Nagar", "Mayur Vihar", "Najafgarh", "Narela", "Okhla", "Paschim Vihar", "Pitampura"],
        "Jammu and Kashmir": ["Srinagar", "Jammu", "Anantnag", "Baramulla", "Kupwara", "Udhampur", "Pulwama", "Sopore", "Kathua", "Budge Budge", "Bandipora", "Poonch", "Rajouri", "Samba", "Reasi", "Doda", "Kishtwar", "Ramban"],
        "Ladakh": ["Leh", "Kargil", "Diskit", "Nyoma", "Dras", "Padum", "Khalsi"],
        "Lakshadweep": ["Kavaratti", "Agatti", "Minicoy", "Amini", "Andrott", "Kalpeni", "Kadmat", "Kiltan", "Chetlat", "Bitra"],
        "Puducherry": ["Puducherry", "Karaikal", "Mahe", "Yanam", "Ozhukarai", "Ariyankuppam", "Villianur", "Bahour"]
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

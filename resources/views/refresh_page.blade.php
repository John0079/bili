<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios.post('/refresh', {
        params: {
            refresh_token: "def50200b1a5c2dff9cc299a046e4151134e94174ee05843bc865aee42f2b6209726b45eebc2a9f1faf91ded3c15c9eecf059f48e6a56f70de9226ebba0e922c18b45f478a46c09612bedce26ad48c587a2e5c5c9d8cb4416d02f4746f6d710f70bd782eaf6ebed659510cb2088f7e72900990dc4871a717e96a9c549549a7e0ca5f1dae695e7ad5f8813d711b27f7cf2f0411d881dc29b889cbec283637a2c50ea761af92fef6374264699d0ec10432c27b8edec7a4754ee6f7550b16af9fdba29e591dd96073a28990a18d8404bf9e0c1a63f491e685ea46959e020228276160fd553078e0384eb036ce90fc1fd6db9da1cf4b2d86cff6c1ac0f2bf9a327bf5a9c03e78b1df518937ff811e9399460bb3aa215addca7ed0068b143f6b5d9e9f2e1498d241b0f71717262a91fde12ccb632d04e3be8d82df146f89ed69326cbee237f48fc295a1ca054ef05bcd9ce0cd8d75e3b9f32b68b543840f6f3cf9775c2"
        }
    })
        .then(function (response) {
            console.log(response.data);
        });
</script>
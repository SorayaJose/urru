<div>
    <select id="rubros" name="rubros[]"
        class="selectpicker">
        <option value="1">1 dormitorio</option>
        <option value="2">2 dormitorios</option>
        <option value="3">3 dormitorios</option>
        <option value="4">4 dormitorios</option>
        <option value="5">5 dormitorios</option>
    </select>

    <script>
        document.addEventListener('livewire:load', function() {
            $('.selectpicker').selectpicker();
        })
    </script>
</div>

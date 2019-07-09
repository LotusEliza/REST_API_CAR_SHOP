export default {
    computed: {
        filteredBlogs: function () {
            return this.cars.filter((car) => {
                return car.brand.match(this.search);
            } )
        }
    }
}
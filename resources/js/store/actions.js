const actions = {
    getList(context, payload) {
        axios.get('/list')
        .then(response => context.commit('getList', response.data))
        .catch(error => this.errors = error.response.state)
    },
}
export default actions

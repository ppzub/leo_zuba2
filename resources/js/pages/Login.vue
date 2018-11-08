<template>
	<div class="row">
		<div class="col-sm-12">
			<div class="card shadow p-3 mb-5 bg-white rounded">
				<h5 class="card-header">Login page</h5>

				<div class="card-body">
					<div class="alert alert-danger" v-if="has_error && !success">
						<p>Помилка, не вдається з'єднатися з цими обліковими даними.</p>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-4">
							<form autocomplete="off" @submit.prevent="login" v-if="!success" method="post">

							<div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
								<label for="email">E-mail</label>
								<input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
								<span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
							</div>

							<div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
								<label for="password">Password</label>
								<input type="password" id="password" class="form-control" v-model="password" required>
								<span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
							</div>
								<button type="submit" class="btn btn-dark">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
data() {
	return {
		email: null,
		password: null,
		has_error: false,
		error: '',
		errors: {},
		success: false
		}
	},

methods: {
	login() {
		let app = this
		this.$auth.login({
			params: {
				email: app.email,
				password: app.password
			},
			success: function() {
				this.$router.push({name: 'dashboard'})
			},
			error: function (res) {
				console.log(res.response.data.errors)
				app.has_error = true
				app.error = res.response.data.error
				app.errors = res.response.data.errors || {}
			},
			rememberMe: true,
			fetchUser: true
		})
		}
	}
}
</script>

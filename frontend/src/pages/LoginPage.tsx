import React from "react"
import { LoginForm } from "@/components/auth/login-form"
import AuthLayout from "@/layouts/AuthLayout"

const LoginPage: React.FC = () => {
  return (
    <AuthLayout>
      <LoginForm />
    </AuthLayout>
  )
}
export default LoginPage;
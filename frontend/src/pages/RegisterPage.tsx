import React from "react"
import { RegisterForm } from "@/components/register-form"
import AuthLayout from "@/layouts/AuthLayout"

const RegisterPage: React.FC = () => {
  return (
    <AuthLayout>
      <RegisterForm />
    </AuthLayout>
  )
}
export default RegisterPage;
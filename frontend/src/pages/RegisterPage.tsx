import React, { useState } from "react"
import { useNavigate } from "react-router-dom"
import { register } from "@/api/auth"
import { RegisterForm } from "@/components/auth/register-form"
import AuthLayout from "@/layouts/AuthLayout"

const RegisterPage: React.FC = () => {
  const navigate = useNavigate()
  const [error, setError] = useState<string | null>(null)

  const handleRegister = async (formData: { name: string; email: string; password: string, role_id: string }) => {
    try {
      const response = await register(formData)
      if (response) {
        navigate("/login")
      }
    } catch (err: any) {
      setError(err.response?.data?.message || "Registration failed")
    }
  }

  return (
    <AuthLayout>
      {error && <p className="text-red-500 text-center">{error}</p>}
      <RegisterForm onSubmit={handleRegister} />
    </AuthLayout>
  )
}

export default RegisterPage

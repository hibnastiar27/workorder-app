import { GalleryVerticalEnd } from "lucide-react"
import React, { useState } from "react"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from "@/components/ui/select"
import { toast } from "sonner"
import { Link } from "react-router-dom"

interface RegisterFormProps {
  onSubmit: (formData: { name: string; email: string; password: string; role_id: string }) => void
}

export const RegisterForm: React.FC<RegisterFormProps> = ({ onSubmit }) => {
  const [formData, setFormData] = useState({ name: "", email: "", password: "", role_id: "" })

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target
    setFormData({ ...formData, [name]: value })
  }

  const handleRoleChange = (value: string) => {
    setFormData({ ...formData, role_id: value })
  }

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    onSubmit(formData)
    toast("Event has been created", {
      description: "Sunday, December 03, 2023 at 9:00 AM",
      action: {
        label: "Undo",
        onClick: () => console.log("Undo"),
      },
    })
  }

  return (
    <form onSubmit={handleSubmit} className="flex flex-col gap-4">
      <div className="flex flex-col items-center gap-2">
        <Link to="/" className="flex flex-col items-center gap-2 font-medium">
          <div className="flex size-8 items-center justify-center rounded-md">
            <GalleryVerticalEnd className="size-6" />
          </div>
        </Link>
        <h1 className="text-xl font-bold">Workorders App</h1>
        <div className="text-center text-sm">
          Do you have an account?{" "}
          <Link to="/login" className="underline underline-offset-4">
            Login
          </Link>
        </div>
      </div>
      <div className="grid gap-3">
        <Label htmlFor="name">Name</Label>
        <Input
          id="name"
          name="name"
          type="text"
          value={formData.name}
          onChange={handleChange}
          placeholder="Your name"
          required
        />
      </div>
      <div className="grid gap-3">
        <Label htmlFor="email">Email</Label>
        <Input
          id="email"
          name="email"
          type="email"
          value={formData.email}
          onChange={handleChange}
          placeholder="Your email"
          required
        />
      </div>
      <div className="grid gap-3">
        <Label htmlFor="password">Password</Label>
        <Input
          id="password"
          name="password"
          type="password"
          value={formData.password}
          onChange={handleChange}
          placeholder="Your password"
          required
        />
      </div>
      <div className="grid gap-3">
        <Label htmlFor="role">Role<span className="text-red-500">*</span></Label>
        <Select onValueChange={handleRoleChange}>
          <SelectTrigger className="w-full">
            <SelectValue placeholder="Pilih role anda" />
          </SelectTrigger>
          <SelectContent>
            <SelectItem value="1">Production Manager</SelectItem>
            <SelectItem value="2">Operator</SelectItem>
          </SelectContent>
        </Select>
      </div>
      <Button type="submit" className="w-full">
        Register
      </Button>
    </form>
  )
}


// export const RegisterForm: React.FC<RegisterFormProps> = ({
//   className,
//   ...props
// }: React.ComponentProps<"div">) {

//   return (
//     <div className={cn("flex flex-col gap-6", className)} {...props}>
//       <form onSubmit={handleSubmit}>
//         <div className="flex flex-col gap-6">
//           <div className="flex flex-col items-center gap-2">
//             <Link to="/" className="flex flex-col items-center gap-2 font-medium">
//               <div className="flex size-8 items-center justify-center rounded-md">
//                 <GalleryVerticalEnd className="size-6" />
//               </div>
//             </Link>
//             <h1 className="text-xl font-bold">Workorders App</h1>
//             <div className="text-center text-sm">
//               Do you have an account?{" "}
//               <Link to="/login" className="underline underline-offset-4">
//                 Login
//               </Link>
//             </div>
//           </div>

//           <div className="flex flex-col gap-4">
//             <div className="grid gap-3">
//               <Label htmlFor="name">Name<span className="text-red-500">*</span></Label>
//               <Input
//                 id="name"
//                 type="name"
//                 placeholder="Masukan name lengkap"
//                 required
//               />
//             </div>

//             <div className="grid gap-3">
//               <Label htmlFor="email">Email<span className="text-red-500">*</span></Label>
//               <Input
//                 id="email"
//                 type="email"
//                 placeholder="Masukan email yang valid"
//                 required
//               />
//             </div>

//             <div className="grid gap-3">
//               <Label htmlFor="password">Password<span className="text-red-500">*</span></Label>
//               <Input
//                 id="password"
//                 type="password"
//                 placeholder="Masukan password anda"
//                 required
//               />
//             </div>

//             <div className="grid gap-3">
//               <Label htmlFor="role">Role<span className="text-red-500">*</span></Label>
//               <Select >
//                 <SelectTrigger className="w-full">
//                   <SelectValue placeholder="Pilih role anda" />
//                 </SelectTrigger>
//                 <SelectContent>
//                   <SelectItem value="1">Production Manager</SelectItem>
//                   <SelectItem value="2">Operator</SelectItem>
//                 </SelectContent>
//               </Select>

//             </div>
//             <Button type="submit" className="w-full">
//               Register
//             </Button>
//           </div>
//         </div>
//       </form >
//     </div >
//   )
// }

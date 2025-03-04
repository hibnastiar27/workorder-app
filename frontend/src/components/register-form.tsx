import { GalleryVerticalEnd } from "lucide-react"

import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

export function RegisterForm({
  className,
  ...props
}: React.ComponentProps<"div">) {
  return (
    <div className={cn("flex flex-col gap-6", className)} {...props}>
      <form>
        <div className="flex flex-col gap-6">
          <div className="flex flex-col items-center gap-2">
            <a href="/login" className="flex flex-col items-center gap-2 font-medium">
              <div className="flex size-8 items-center justify-center rounded-md">
                <GalleryVerticalEnd className="size-6" />
              </div>
            </a>
            <h1 className="text-xl font-bold">Workorders App</h1>
            <div className="text-center text-sm">
              Do you have an account?{" "}
              <a href="/login" className="underline underline-offset-4">
                Login
              </a>
            </div>
          </div>
          <div className="flex flex-col gap-4">
            <div className="grid gap-3">
              <Label htmlFor="name">Name<span className="text-red-500">*</span></Label>
              <Input
                id="name"
                type="name"
                placeholder="Masukan name lengkap"
                required
              />
            </div>
            <div className="grid gap-3">
              <Label htmlFor="email">Email<span className="text-red-500">*</span></Label>
              <Input
                id="email"
                type="email"
                placeholder="Masukan email yang valid"
                required
              />
            </div>
            <div className="grid gap-3">
              <Label htmlFor="password">Password<span className="text-red-500">*</span></Label>
              <Input
                id="password"
                type="password"
                placeholder="Masukan password anda"
                required
              />
            </div>
            <div className="grid gap-3">
              <Label htmlFor="role">Role<span className="text-red-500">*</span></Label>
              <Select >
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
          </div>
        </div>
      </form >
    </div >
  )
}

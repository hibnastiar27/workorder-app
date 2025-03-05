import React, { ReactNode } from 'react'

interface DashboardProps {
  children: ReactNode;
}

const DashboardLayouts: React.FC<DashboardProps> = ({ children }) => {
  return (
    <div className="flex min-h-svh flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
      {/* sidebar */}
      <div className="w-full max-w-sm">
        {children}
      </div>
    </div>
  )
}

export default DashboardLayouts
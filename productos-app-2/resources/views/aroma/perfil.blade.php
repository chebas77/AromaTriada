import { User } from "lucide-react"

export default function ClientRegistration() {
  return (
    <div className="min-h-screen flex flex-col">
      <header className="bg-red-600 h-8"></header>
      
      <main className="flex-grow bg-white p-6 flex flex-col md:flex-row gap-6">
        <div className="md:w-1/3 flex flex-col items-center">
          <div className="relative w-32 h-32 bg-blue-500 rounded-full flex items-center justify-center mb-2">
            <User className="w-20 h-20 text-white" />
            <span className="absolute bottom-0 text-sm text-blue-700">Cambiar</span>
          </div>
          <h2 className="text-lg font-bold text-center mb-4">LOPEZ ROMERO ANGELA JENNIFER</h2>
          <div className="flex gap-2">
            <button className="bg-red-200 text-red-600 px-4 py-2 rounded-full text-sm font-semibold">FAVORITOS</button>
            <button className="bg-red-200 text-red-600 px-4 py-2 rounded-full text-sm font-semibold">BUSCAR</button>
            <button className="bg-red-200 text-red-600 px-4 py-2 rounded-full text-sm font-semibold">FEEDBACK</button>
          </div>
        </div>
        
        <div className="md:w-2/3 bg-gray-100 rounded-lg p-6">
          <h1 className="text-xl font-bold mb-4">REGISTRO DE CLIENTE</h1>
          <div className="space-y-2">
            <p><span className="font-semibold">CONTACTO →</span> 987654321</p>
            <p><span className="font-semibold">DIRECCIÓN →</span> STA.ANITA (ESPALDA DE TECSUP)LOTE 3</p>
            <p><span className="font-semibold">ESPECIALIDAD →</span> MERCADOTECNIA</p>
            <p><span className="font-semibold">HOBBIE →</span> MOCHILERO</p>
            <p><span className="font-semibold">ESTUDIOS →</span> SUPERIOR</p>
            <p><span className="font-semibold">EXPERIENCIA →</span> NINGUNA</p>
          </div>
        </div>
      </main>
      
      <footer className="bg-red-600 h-8"></footer>
    </div>
  )
}
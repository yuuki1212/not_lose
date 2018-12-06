# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "bento/centos-7.3"
  config.vm.network :private_network, ip: "192.168.33.110", autoconfig:false
  config.vm.network :forwarded_port, id: "ssh", guest: 22, host: 2225
  config.vbguest.auto_update = false
  config.vm.synced_folder "../.", "/vagrant", mount_options: ['dmode=777','fmode=777']
  config.vm.provision "shell", run: "always", inline: "systemctl restart network.service"
  config.vm.provider "virtualbox" do |vb|
     vb.memory = "512"
  end
  config.vm.provision "shell", path: "provision/provision.sh"
end

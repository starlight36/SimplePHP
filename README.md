SimplePHP Framework
===================

This is a simple and clear framework designed for php5.3+ with full OOP support.
When I was preparing my graduation project, I want to find a php framework that
I can fully use the new features of php5.3+. But almost all php frameworks keep
themselves compatible with lower version of php, so I can not use namespace to 
manage the classes(actually namespace makes no good to use in those frameworks).
As a result, I decided to write a new framework to meet my needs.

As a full object oriented framework, classes is treated as the smallest unit.
We never write functions outside a class. A root application object manage the 
whole lifecycle of the runtime objects. It seems that it is a Java EE framework.
Actually, I "copied" some features to this php framework and it works well :-).

Case tools can effectively help you to DESIGN a system rather than WRITE a 
system. But unfortunately less case tools support php5.3+'s forward or reverse 
engineering.If you build a open source UML tools(of course with php5.3+ 
support), I will be very grateful.

When I was writing my thesis, I promised to open the framework's source code to
public. Now I fulfilled my promise, the framework has been released with Apache
licence, you can read the licence in current directory.

This framework is still in alpha test stage so far, please don't count on it 
working well without a bug. If you want to contribute to this project, please 
notify me by this email address <me@starlight36.com>.

关于SimplePHP框架
===================

SimplePHP框架是一个专为PHP 5.3以上版本设计的面向对象编程的开发框架。这个项目起源于我的毕业
设计（SimpleOA，一个包含简单工作流引擎的OA系统）。当时我着手寻找一个能够完全支持PHP 5.3
特性的框架。然而遗憾的是，我试验过了一些框架之后发现，为了兼容旧版本的PHP（主要是5.2），放弃
了PHP 5.3之后才加入的宝贵特性例如命名空间支持。所以最后我决定自己编写一个完全基于PHP 5.3的
PHP框架，由此SimplePHP框架得以诞生。

在一个完全面向对象的框架中，类是最小的单元，也就是说，除非在一些极其特殊的应用场合，SimplePHP
完全杜绝类外独立函数的定义。Application对象作为整个系统的根对象管理着整个运行时对象的生命周期。
这一点有点类似于Java Web框架的工作模式（指Servlet）。事实上，这个框架有很多想法，都是从Java
框架的设计思想中借鉴而来。

SimplePHP建议通过CASE工具来“设计”系统，而不是“写”系统。利用UML工具，可以轻而易举的实现设计
类图到代码框架的正向工程，或者代码到类图的反向工程。然而目前支持PHP 5.3以上版本的UML工具非常
之少，据我说知Enterprise Archtect 9.3是支持PHP 5.3的。如果你有更好的选择（开源免费工具
再好不过了），请告诉我。

在编写论文的时候，我承诺将我的框架通过互联网开源（事实上这个承诺被写进了我论文的末章），现在，
是该履行诺言的时候了。SimplePHP将在Apache许可证下发布，这意味着你可以安全地（无版权上的法律
风险）将框架代码应用在商业项目中，也并不要求对框架做出的修改必须开源。当然我还是建议有索取，就
应当有所贡献，人人为我，我为人人。关于Apache许可证的详细信息，可以通过License文件查看。

需要注意的是，这个框架目前仍然处于alpha版本,运行起来可能会存在一些潜在Bug。（其实这个框架已经
在某项目的生产环境中运行了长达半年之久了，完全可以算是beta版本了，不过有些地方还未完成，比如文档，
还是先alpha测试一段时间吧。）如果你幸运的发现了Bug，请将它报告给我，十分感谢。如果想要参与
这个项目，一起贡献力量，或者有什么建议，请通过<me@starlight36.com>来联系我，访问我的博客
http://starlight36.com/

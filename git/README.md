#### Git速查表

| 序号 | 模块 | 功能 |
| -------- | ------- | ------ |
| 1 | CREATE | 关于创建的 |
| 2 | LOCAL CHANGES | 关于本地改动方面的 |
| 3 | COMMIT HISTORY | 关于提交历史的 |
| 4 | BRANCHES & TAGS | 关于分支和标签类的 |
| 5 | UPDATE & PUBLISH | 关于更新和发布的 |
| 6 | MERGE & REBASE | 关于分支合并类的 |
| 7 | UNDO | 关于撤销类的 |
| 8 | SUBMODULE | 关于子模块 |

##### CREATE

从远程仓库获取代码
```
git clone ssh://user@domain.com/repo.git
```

初始化本地仓库
```
git init
```

##### LOCAL CHANGES

查看仓库的状态,(显示已改动的文件)
```
git status
```

比较工作区与最新本地版本库
```
git diff <fileName>
```

添加所有变化（新增 new、修改 modified、删除 deleted）到暂存区
```
git add -A
```

添加所有变化（新增 new、修改 modified）到暂存区，不包括被删除(deleted)文件
```
git add .
```

添加修改(modified)和被删除(deleted)文件，不包括新文件(new)也就是不是被追踪文件（untracked）
```
git add -u
```

添加文件内某些改动到暂存区
```
git add -p <file>
```

提交所有的放在暂存区的文件和已经修改（不在暂存区）的文件，且问件是要被追踪（tracked）的
```
git commit -a
```

提交所有被在暂存区的问件
```
git commit
```

修改上一次提交日志
```
git commit --amend
```

##### COMMIT HISTORY

查看提交日志
```
git log
```

跟踪查看某个文件的历史修改记录
```
git log -p <file>
```

查看文件是谁什么时候修改什么地方
```
git blame <file>
```
##### BRANCHES & TAGS

查看所有分支（包括远程分支）
```
git branch -a
```

查看所有分支（包括远程分支）和最后一次提交日志
```
git branch -av
```

切换分支
```
git checkout <branch>
```

新建分支，不带old-branch为默认在当前分支上建立新分支
```
git branch <new-branch> <old-branch>
```

新建并且换分支
```
git branch -b <new-branch>
```

删除分支，先切换其他分支再删除
```
git branch -d <branch>
```

删除远程分支
```
git push origin --delete <branch>
```

查看标签
```
git tag
```

新建标签
```
git tag <tag-name>
```

删除标签
```
git tag -d <tag-name>
```

推送标签到远程
```
git push origin tag-name
git push origin --tags
```

##### UPDATE & PUBLISH

列出所有的仓库地址
```
git remote -v
```

查看某个仓库的信息
```
git remote show <remote>
```

添加仓库地址
```
git remote add <shortname> <url>
```

从远程更新代码到本地但不合并
```
git fetch <remote>
```

从远程更新代码到本地且合并
```
git pull <remote> <branch>
```

发布到远程地址
```
git push <remote> <branch>
```

删除远程地址分支
```
git branch -dr <remote/branch>
```

上传标签
```
git push --tags
```

##### MERGE & REBASE

合并目标分支到本地分支
```
git merge <branch>
```

合并分支，但是不合并提交记录（commit），rebase合并如果有冲突则一个一个文件的去合并解决冲突
```
git rebase <branch>
```

合并终止
```
git rebase --abort
```

继续合并
```
git rebase --continue
```

使用配置的合并工具来解决冲突
```
git mergetool
```

添加已手动合并的文件
```
git add <resolved-file>
```

删除已手动合并的文件
```
git rm <resolved-file>
```

##### UNDO

回退到最近一个提交
```
git reset --hard HEAD
```

回退到上一次提交（倒数第二次）
```
git reset --hard HEAD^
```

回退某次提交的某个文件
```
git checkout HEAD <file>
```

回退到某个提交，但是不删除commit
```
git revert <commit>
```

彻底回退到某个提交（commit和代码都回退了）
```
git reset --hard <commit>
```

回退到某个提交（commit回退，代码保留）
```
git reset <commit>
```

回退到某个提交，并保留以更改的文件
```
git reset --keep <commit>
```

##### SUBMODULE

添加子模块
```
git submodule add https://github.com/xxxxxx/Test
```

克隆你有子模块的项目
```
git clone https://github.com/xxxxxx/MainProject    
cd MainProject                //  子模块目录Test没有文件
cd Test
git submodule init
git submodule update     // 执行完后就有子模块的代码了

//方法二
// 自动更新子模块中的代码
git clone --recurse-submodules https://github.com/xxxxxx/MainProject
```

合并两个不同的项目
```
// 需使用 `--allow-unrelated-histories`
// 将远程master项目合并到你本地项目
git pull origin master --allow-unrelated-histories
```